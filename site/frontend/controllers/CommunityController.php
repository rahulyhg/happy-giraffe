<?php
Yii::import('site.frontend.modules.geo.models.*');

class CommunityController extends Controller
{

    public $layout = '//layouts/main';

    public $community;
    public $rubric_id;
    public $content_type_slug;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'list', 'view', 'fixList', 'fixUsers', 'fixSave', 'fixUser', 'shortList', 'shortListContents'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions' => array('add', 'edit', 'addTravel', 'editTravel', 'delete', 'transfer'),
                'users' => array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $communities = Community::model()->findAll();
        $this->render('index', array(
            'communities' => $communities,
        ));
    }

    /**
     * @sitemap dataSource=getCommunityUrls
     */
    public function actionList($community_id, $rubric_id = null, $content_type_slug = null)
    {
        $this->layout = '//layouts/community';
        $this->community = Community::model()->with('rubrics')->findByPk($community_id);
        if ($this->community === null)
            throw CHttpException(404, 'Клуб не найден');
        $this->rubric_id = $rubric_id;
        $this->content_type_slug = $content_type_slug;

        if ($rubric_id !== null) {
            $rubric = CommunityRubric::model()->findByPk($rubric_id);
            if ($rubric === null)
                throw CHttpException(404, 'Рубрика не найдена');
            $this->pageTitle = 'Клуб «' . $this->community->name . '» – рубрика «' . $rubric->name . '» у Веселого Жирафа';
        } else {
            $this->pageTitle = 'Клуб «' . $this->community->name . '» - общение с Веселым Жирафом';
        }

        $contents = CommunityContent::model()->getContents($community_id, $rubric_id, $content_type_slug);

        $this->render('list', array(
            'contents' => $contents,
        ));
    }

    public function getUrl($overwrite = array(), $route = 'community/list')
    {
        return array_filter(CMap::mergeArray(
            array($route),
            array(
                'community_id' => $this->community->id,
                'rubric_id' => $this->rubric_id,
                'content_type_slug' => $this->content_type_slug,
            ),
            $overwrite
        ));
    }

    /**
     * @sitemap dataSource=getContentUrls
     */
    public function actionView($community_id, $content_type_slug, $content_id)
    {
        $this->layout = '//layouts/community';
        $content = CommunityContent::model()->active()->full()->findByPk($content_id);
        if ($content === null)
            throw new CHttpException(404, 'Такой записи не существует');

        $this->community = Community::model()->with('rubrics')->findByPk($community_id);
        $this->rubric_id = $content->rubric->id;
        $this->content_type_slug = $content_type_slug;

        $this->pageTitle = (! empty($content->meta_title)) ? $content->meta_title : $this->pageTitle = $content->name;

        $this->render('view', array(
            'data' => $content,
        ));
    }

    public function actionEdit($content_id)
    {
        $content_id = (int) $content_id;
        $content_model = CommunityContent::model()->full()->findByPk($content_id);
        if ($content_model === null)
        {
            throw new CHttpException(404, 'Такой записи не существует.');
        }
        if ($content_model->author_id != Yii::app()->user->getId() &&
            !Yii::app()->authManager->checkAccess('removeCommunityContent', Yii::app()->user->getId(),
                array('community_id'=>$content_model->rubric->community_id)) &&
            !Yii::app()->authManager->checkAccess('transfer post', Yii::app()->user->getId())
        ) {
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        }
        $communities = Community::model()->findAll();
        $slave_model = $content_model->{$content_model->type->slug};
        $slave_model_name = get_class($slave_model);

        if (isset($_POST['CommunityContent'], $_POST[$slave_model_name]))
        {
            $content_model->attributes = $_POST['CommunityContent'];
            $slave_model->attributes = $_POST[$slave_model_name];
            //$slave_model->attributes = $_POST;
            $valid = $content_model->validate();
            $valid = $slave_model->validate() && $valid;

            if ($valid)
            {
                $content_model->save();
                $slave_model->save();
                $this->redirect(array('community/view', 'community_id' => $content_model->rubric->community->id,
                    'content_type_slug' => $content_model->type->slug, 'content_id' => $content_model->id));
            }
        }

        $this->render('edit', array(
            'communities' => $communities,
            'content_model' => $content_model,
            'slave_model' => $slave_model,
            'community' => $content_model->rubric->community,
            'content_type' => $content_model->type,
        ));
    }

    public function actionTransfer()
    {
        if (!Yii::app()->authManager->checkAccess('transfer post', Yii::app()->user->getId()))
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');

        $model = CommunityContent::model()->findByPk(Yii::app()->request->getPost('id'));
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');

        $model->attributes = $_POST['CommunityContent'];
        if ($model->save()) {
            $url = $this->createUrl('community/view', array(
                'community_id' => $model->rubric->community->id,
                'content_type_slug' => $model->type->slug,
                'content_id' => $model->id));

            $response = array(
                'status' => true,
                'url' => $url
            );
        } else {
            $response = array(
                'status' => false,
            );
        }

        echo CJSON::encode($response);
    }

    public function actionAdd($community_id, $rubric_id = null, $content_type_slug = 'post')
    {
        $content_type = CommunityContentType::model()->findByAttributes(array('slug' => $content_type_slug));
        if (! $content_type)
        {
            throw new CHttpException(404, 'Такого раздела не существует.');
        }
        $community = Community::model()->with('rubrics')->findByPk($community_id);
        if (! $community)
        {
            throw new CHttpException(404, 'Такого сообщества не существует.');
        }
        $content_types = CommunityContentType::model()->findAll();
        $content_model = new CommunityContent;
        $content_model->rubric_id = $rubric_id;
        $content_model->author_id = Yii::app()->user->id;
        $slave_model_name = 'Community' . ucfirst($content_type->slug);
        $slave_model = new $slave_model_name;

        if (isset($_POST['CommunityContent'], $_POST[$slave_model_name]))
        {
            $content_model->attributes = $_POST['CommunityContent'];
            $slave_model->attributes = $_POST[$slave_model_name];
            //$slave_model->attributes = $_POST;

            $valid = $content_model->validate();
            $valid = $slave_model->validate() && $valid;

            if ($valid)
            {
                $content_model->save(false);
                $slave_model->content_id = $content_model->id;
                $slave_model->save(false);
                $this->redirect(array('community/view', 'community_id' => $community_id, 'content_type_slug' => $content_model->type->slug, 'content_id' => $content_model->id));
            }
        }

        $this->render('add', array(
            'content_model' => $content_model,
            'slave_model' => $slave_model,
            'community' => $community,
            'content_types' => $content_types,
            'content_type' => $content_type,
            'community_id' => $community_id,
            'rubric_id' => $rubric_id,
        ));
    }

    public function actionAddTravel()
    {
        $community_id = 21;
        $rubric_id = 151;
        $community = Community::model()->findByPk($community_id);
        $content_types = CommunityContentType::model()->findAll();
        $content_type = CommunityContentType::model()->findByAttributes(array('slug' => 'travel'));

        $content_model = new CommunityContent;
        $content_model->rubric_id = $rubric_id;
        $content_model->author_id = Yii::app()->user->id;
        $slave_model = new CommunityTravel;

        $waypoints = array();
        if (isset($_POST['CommunityContent'], $_POST['CommunityTravel'], $_POST['CommunityTravelWaypoint']))
        {
            $content_model->attributes = $_POST['CommunityContent'];
            $slave_model->attributes = $_POST['CommunityTravel'];
            $images = CUploadedFile::getInstancesByName('CommunityTravelImage[image]');

            $valid = $content_model->validate();
            $valid = $slave_model->validate() && $valid;

            foreach ($_POST['CommunityTravelWaypoint'] as $w)
            {
                if (! empty($w['city_id']) && ! empty($w['country_id']))
                {
                    $waypoint = new CommunityTravelWaypoint;
                    $waypoint->attributes = $w;
                    $valid = $waypoint->validate() && $valid;
                    $waypoints[] = $waypoint;
                }
            }

            $j = 0;
            foreach ($images as $i)
            {
                $valid = (! $i->hasError) && $valid;
                $slave_model->addError('name', 'Произошла ошибка при загрузке файла #' . ++$j . '.');
            }

            if ($valid)
            {
                $content_model->save(false);
                $slave_model->content_id = $content_model->id;
                $slave_model->save(false);
                foreach ($waypoints as $waypoint)
                {
                    $waypoint->travel_id = $slave_model->id;
                    $waypoint->save(false);
                }
                foreach ($images as $i)
                {
                    if ($i->saveAs(Yii::getPathOfAlias('webroot').'/upload/travels/original/'.$i->name))
                    {
                        $image = new CommunityTravelImage;
                        $image->image = $i->name;
                        $image->travel_id = $slave_model->id;
                        $image->save();

                        FileHandler::run(Yii::getPathOfAlias('webroot').'/upload/travels/original/'.$i->name, Yii::getPathOfAlias('webroot').'/upload/travels/thumb/'.$i->name, array(
                            'resize' => array(
                                'width' => 170,
                                'height' => 180,
                            ),
                        ));
                    }
                }
                $this->redirect(array('community/view', 'community_id' => $community_id, 'content_type_slug' => $content_model->type->slug, 'content_id' => $content_model->id));
            }
        }

        $this->render('add', array(
            'content_model' => $content_model,
            'slave_model' => $slave_model,
            'community' => $community,
            'content_types' => $content_types,
            'content_type' => $content_type,
            'community_id' => $community_id,
            'rubric_id' => $rubric_id,
            'waypoints' => $waypoints,
        ));
    }

    public function actionEditTravel($id)
    {
        $community_id = 21;
        $rubric_id = 151;
        $community = Community::model()->findByPk($community_id);
        $content_types = CommunityContentType::model()->findAll();
        $content_type = CommunityContentType::model()->findByAttributes(array('slug' => 'travel'));

        $content_model = CommunityContent::model()->with('travel.waypoints')->findByPk($id);
        if ($content_model === null)
        {
            throw new CHttpException(404, 'Такой записи не существует.');
        }
        $slave_model = $content_model->travel;

        $waypoints = array();
        if (isset($_POST['CommunityContent'], $_POST['CommunityTravel'], $_POST['CommunityTravelWaypoint']))
        {
            $content_model->attributes = $_POST['CommunityContent'];
            $slave_model->attributes = $_POST['CommunityTravel'];

            $valid = $content_model->validate();
            $valid = $slave_model->validate() && $valid;

            foreach ($_POST['CommunityTravelWaypoint'] as $w)
            {
                if (! empty($w['city_id']) && ! empty($w['country_id']))
                {
                    $waypoint = new CommunityTravelWaypoint;
                    $waypoint->attributes = $w;
                    $valid = $waypoint->validate() && $valid;
                    $waypoints[] = $waypoint;
                }
            }

            if ($valid)
            {
                $content_model->save(false);
                $slave_model->content_id = $content_model->id;
                $slave_model->save(false);
                CommunityTravelWaypoint::model()->deleteAllByAttributes(array('travel_id' => $slave_model->id));
                foreach ($waypoints as $waypoint)
                {
                    $waypoint->travel_id = $slave_model->id;
                    $waypoint->save(false);
                }
                $this->redirect(array('community/view', 'community_id' => $community_id, 'content_type_slug' => $content_model->type->slug, 'content_id' => $content_model->id));
            }
        }

        $this->render('add', array(
            'content_model' => $content_model,
            'slave_model' => $slave_model,
            'community' => $community,
            'content_types' => $content_types,
            'content_type' => $content_type,
            'community_id' => $community_id,
            'rubric_id' => $rubric_id,
            'waypoints' => $waypoints,
        ));
    }

    public function getContentUrls()
    {
        $models = CommunityContent::model()->with(array('rubric.community'))->findAll();
        $data = array();
        foreach ($models as $model)
        {
            $data[] = array(
                'params'=>array(
                    'community_id' => $model->rubric->community->id,
                    'content_type_slug' => $model->type->slug,
                    'content_id' => $model->id,
                ),

                'lastmod' => $model->created,
            );
        }
        return $data;
    }

    public function getCommunityUrls()
    {
        $models = Community::model()->findAll();
        $data = array();
        foreach ($models as $model)
        {
            $lastmod = CommunityContent::model()->with('rubric.community')->find(array(
                'condition' => 'community_id = :community_id',
                'params' => array(':community_id' => $model->id),
                'order' => 'created DESC',
            ));
            $data[] = array(
                'params'=>array(
                    'community_id' => $model->id,
                ),

                'lastmod' => $lastmod->created,
            );
        }
        return $data;
    }

    public function actionFixList()
    {
        $criteria = new CDbCriteria(
            array(
                'condition' => 't.id > :id_from AND t.id <= :id_till',
                'params' => array(
                    ':id_from' => 1647,
                    ':id_till' => 1968,
                ),
                'with' => array(
                    'type',
                    'rubric' => array(
                        'with' => array(
                            'community',
                        ),
                    ),
                ),
            )
        );

        $file = file_get_contents(Yii::getPathOfAlias('webroot') . '/fix.txt');
        $updated = array_unique(explode("\n", $file));
        $criteria->addNotInCondition('t.id', $updated);

        $contents = CommunityContent::model()->findAll($criteria);

        $this->render('fixlist', array(
            'contents' => $contents,
        ));
    }

    public function actionFixUsers()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $users = User::model()->findAll(array(
                'condition' => 'email LIKE :term',
                'params' => array(':term' => $_GET['term'] . '%'),
            ));

            $_users = array();
            foreach ($users as $user)
            {
                $_users[] = array(
                    'label' => $user->email,
                    'value' => $user->email,
                    'id' => $user->id,
                );
            }
            echo CJSON::encode($_users);
        }
    }

    public function actionFixSave()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $content = CommunityContent::model()->findByPk($_POST['content_id']);
            $content->author_id = $_POST['author_id'];
            if ($content->save())
            {
                file_put_contents(Yii::getPathOfAlias('webroot') . '/fix.txt', $_POST['content_id'] . "\n", FILE_APPEND);
            }
        }
    }

    public function actionFixUser()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $user = User::model()->findByPk($_POST['author_id']);
            $response = $this->renderPartial('fixuser', array('user' => $user), true);
            echo $response;
        }
    }

    public function actionShortList()
    {
        $contents = Community::model()->with('rubrics')->findAll();

        $this->render('shortList', array(
            'contents' => $contents,
        ));
    }

    public function actionShortListContents($rubric_id)
    {
        $model = CommunityRubric::model()->with(array('community', 'contents.type'))->findByPk($rubric_id);
        foreach ($model->contents as $c)
        {
            echo CHtml::tag('li', array(), '&nbsp;&nbsp;&nbsp;&nbsp;' . CHtml::link($c->name, array(
                'community/view',
                'community_id' => $model->community->id,
                'content_type_slug' => $c->type->slug,
                'content_id' => $c->id,
            )));
        }
    }
}