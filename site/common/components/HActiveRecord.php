<?php

/**
 * Author: choo
 * Date: 25.04.2012
 */
class HActiveRecord extends CActiveRecord
{
    const OP_INSERT = 0x01;
    const OP_UPDATE = 0x02;
    const OP_DELETE = 0x04;
    const OP_ALL = 0x07;

    public function transactions()
    {
        return [];
    }

    public function isTransactional($operation)
    {
        $scenario = $this->getScenario();
        $transactions = $this->transactions();

        return isset($transactions[$scenario]) && ($transactions[$scenario] & $operation);
    }

    /**
     * @inheritdoc
     */
    public function insert($attributes = null)
    {
        if (!$this->isTransactional(self::OP_INSERT)) {
            return $this->insertInternal($attributes);
        }

        $transaction = $this->getDbConnection()->beginTransaction();
        try {
            $result = $this->insertInternal($attributes);
            if ($result === false) {
                $transaction->rollback();
            } else {
                $transaction->commit();
            }
            return $result;
        } catch (\Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    protected function insertInternal($attributes)
    {
        if (!$this->getIsNewRecord())
            throw new CDbException(Yii::t('yii', 'The active record cannot be inserted to database because it is not new.'));
        if ($this->beforeSave()) {
            Yii::trace(get_class($this) . '.insert()', 'system.db.ar.CActiveRecord');
            $builder = $this->getCommandBuilder();
            $table = $this->getTableSchema();
            $command = $builder->createInsertCommand($table, $this->getAttributes($attributes));
            if ($command->execute()) {
                $primaryKey = $table->primaryKey;
                if ($table->sequenceName !== null) {
                    if (is_string($primaryKey) && $this->$primaryKey === null)
                        $this->$primaryKey = $builder->getLastInsertID($table);
                    elseif (is_array($primaryKey)) {
                        foreach ($primaryKey as $pk) {
                            if ($this->$pk === null) {
                                $this->$pk = $builder->getLastInsertID($table);
                                break;
                            }
                        }
                    }
                }
                $this->setOldPrimaryKey($this->getPrimaryKey());
                $this->afterSave();
                $this->setIsNewRecord(false);
                $this->setScenario('update');
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function update($attributes = null)
    {
        if (!$this->isTransactional(self::OP_UPDATE)) {
            return $this->updateInternal($attributes);
        }

        $transaction = $this->getDbConnection()->beginTransaction();
        try {
            $result = $this->updateInternal($attributes);
            if ($result === false) {
                $transaction->rollback();
            } else {
                $transaction->commit();
            }
            return $result;
        } catch (\Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    protected function updateInternal($attributes = null)
    {
        if ($this->beforeSave()) {
            Yii::trace(get_class($this) . '.update()', 'system.db.ar.CActiveRecord');
            if ($this->getOldPrimaryKey() === null)
                $this->setOldPrimaryKey($this->getPrimaryKey());
            $this->updateByPk($this->getOldPrimaryKey(), $this->getAttributes($attributes));
            $this->setOldPrimaryKey($this->getPrimaryKey());
            $this->afterSave();
            return true;
        } else
            return false;
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        if (!$this->isTransactional(self::OP_DELETE)) {
            return $this->deleteInternal();
        }

        $transaction = $this->getDbConnection()->beginTransaction();
        try {
            $result = $this->deleteInternal();
            if ($result === false) {
                $transaction->rollback();
            } else {
                $transaction->commit();
            }
            return $result;
        } catch (\Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    protected function deleteInternal()
    {
        if (!$this->getIsNewRecord()) {
            Yii::trace(get_class($this) . '.delete()', 'system.db.ar.CActiveRecord');
            if ($this->beforeDelete()) {
                $result = $this->deleteByPk($this->getPrimaryKey()) > 0;
                $this->afterDelete();
                return $result;
            } else
                return false;
        } else
            throw new CDbException(Yii::t('yii', 'The active record cannot be deleted because it is new.'));
    }

    // Зачем это?
    private $_attributes;
    private $_related;

    private $_apiWith = array();
    private $_apiRelated;
    private static $_apiMd = array();

    private $_entities = array(
        'post' => 'Пост',
        'video' => 'Видео',
        'photo' => 'Фото',
    );

    public function getPhotoCollection($key = 'default')
    {
        /** @var site\frontend\modules\photo\components\PhotoCollectionBehavior $behavior */
        if ($behavior = $this->asa('PhotoCollectionBehavior')) {
            return $behavior->getPhotoCollection($key);
        }

        return $this->photos;
    }

    public function getPhotoCollectionDependency()
    {
        $sql = "
            SELECT MAX(p.created) FROM album__photo_attaches pa
            INNER JOIN album__photos p ON pa.photo_id = p.id
            WHERE pa.entity = :entity AND pa.entity_id = :entity_id;
        ";

        return array(
            'class' => 'system.caching.dependencies.CDbCacheDependency',
            'sql' => $sql,
            'params' => array(':entity' => get_class($this), ':entity_id' => $this->id),
        );
    }

    public function getErrorsText()
    {
        $errorText = '';
        foreach ($this->getErrors() as $error) {
            foreach ($error as $errorPart)
                $errorText .= $errorPart . ' ';
        }

        return $errorText;
    }

    public function getShare($service)
    {
        switch ($service) {
            case 'vkontakte':
                $url = 'http://vk.com/share.php?title={title}&description={description}&url={url}&image={image}';
                break;
            case 'odnoklassniki':
                $url = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments={description}&st._surl={url}';
                break;
            default:
                $url = '';
        }

        return strtr($url, array(
            '{title}' => urlencode($this->shareTitle),
            '{description}' => urlencode($this->shareDescription),
            '{image}' => urlencode($this->shareImage),
            '{url}' => urlencode($this->shareUrl),
        ));
    }

    public function getShareTitle()
    {
        return ($this->hasAttribute('title') ? $this->title : '');
    }

    public function getShareDescription()
    {
        return ($this->hasAttribute('description') ? $this->description : '');
    }

    public function getShareImage()
    {
        return (isset($this->getMetaData()->relations['photo']) && $this->photo instanceof AlbumPhoto) ? $this->photo->getPreviewPath(180, 180) : '';
    }

    public function getShareUrl()
    {
        return $this->getUrl(false, true);
    }

    public function getRelatedModel($condition = '', $params = array())
    {
        return ($this->hasAttribute('entity') && $this->hasAttribute('entity_id')) ? CActiveRecord::model($this->entity)->resetScope()->findByPk($this->entity_id, $condition, $params) : null;
    }

    public function getEntity()
    {
        switch (get_class($this)) {
            case 'AlbumPhoto':
                return 'photo';
            case 'CookRecipe':
                return 'cook';
            case 'CommunityContent':
            case 'BlogContent':
                return $this->type_id == 1 ? 'post' : 'video';
        }
    }

    public function getEntityTitle()
    {
        return $this->_entities[$this->entity];
    }

    public function getCacheId($keyword)
    {
        return __CLASS__ . $this->primaryKey . $keyword;
    }

    public function getLikedUsers($limit)
    {
        $likes = HGLike::model()->findAllByEntity($this);

        $usersIds = array_map(function ($like) {
            return $like['user_id'];
        }, $likes);

        $criteria = new CDbCriteria();
        $criteria->limit = $limit;
        if (!Yii::app()->user->isGuest)
            $criteria->compare('t.id', '<>' . Yii::app()->user->id);
        $criteria->addInCondition('t.id', $usersIds);
        $users = User::model()->findAll($criteria);

        return $users;
    }

    public function getFavouritedUsers($limit)
    {
        $favourites = Favourite::model()->getAllByModel($this, $limit);
        $users = array_map(function ($favourite) {
            return $favourite->user;
        }, $favourites);
        return $users;
    }

    public function getEntityName()
    {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }

    public function apiRelations()
    {
        return array();
    }

    public function apiWith($name)
    {
        if (array_search($name, $this->_apiWith) === false) {
            $this->_apiWith[] = $name;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function query($criteria, $all = false)
    {
        $result = parent::query($criteria, $all);

        $md = $this->getApiMd();
        foreach ($this->_apiWith as $relationName) {
            $relation = $md[$relationName];
            $className = $relation->className;
            $pks = array_map(function ($model) use ($relation) {
                return $model->{$relation->foreignKey};
            }, $result);
            Yii::beginProfile('getUserPack');
            $models = $className::model()->findAllByPk($pks, $relation->params);
            Yii::endProfile('getUserPack');
            foreach ($result as $model) {
                $model->addApiRelated($relationName, $models[$model->{$relation->foreignKey}]);
            }
        }

        return $result;
    }

    public function addApiRelated($name, $record)
    {
        $this->_apiRelated[$name] = $record;
    }

    public function getApiRelated($name, $refresh = false, $params = array())
    {
        if (!isset($this->_apiRelated[$name]) || $refresh) {
            $md = $this->getApiMd();
            /** @var site\frontend\components\api\ApiRelation $relation */
            $relation = $md[$name];
            /** @var HActiveRecord $className*/
            $className = $relation->className;
            $params = array_merge($relation->params, $params);
            $params['id'] = $this->{$relation->foreignKey};
            Yii::beginProfile('getUser');
            $this->addApiRelated($name, $className::model()->query('get', $params));
            Yii::endProfile('getUser');
        }
        return $this->_apiRelated[$name];
    }

    public function getApiMd()
    {
        $className = get_class($this);
        if (!array_key_exists($className, self::$_apiMd)) {
            self::$_apiMd[$className] = array();
            foreach ($this->apiRelations() as $name => $config) {
                if (isset($config[0], $config[1], $config[2])) {
                    self::$_apiMd[$className][$name] = new site\frontend\components\api\ApiRelation($config[0], $config[1], $config[2], array_slice($config, 3));
                } else {
                    throw new CException('Неверное описание API-отношеня');
                }
            }
        }
        return self::$_apiMd[$className];
    }

    public function __get($name)
    {
        if (($apiMd = $this->getApiMd()) && isset($apiMd[$name])) {
            return $this->getApiRelated($name);
        } else {
            return parent::__get($name);
        }
    }
}
