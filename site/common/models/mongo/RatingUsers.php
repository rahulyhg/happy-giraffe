<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Eugene
 * Date: 02.03.12
 * Time: 16:42
 * To change this template use File | Settings | File Templates.
 */
class RatingUsers extends EMongoDocument
{
    public $uid;
    public $key;
    public $entity = array();


    public function getCollectionName()
    {
        return 'rating_users';
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('uid, key, entity', 'safe'),
        );
    }

    public function findByUser($uid, $key)
    {
        $model = RatingUsers::model()->findByAttributes(array(
            'uid' => $uid,
            'key' => $key
        ));
        if(!$model)
        {
            $model = new RatingUsers;
            $model->uid = $uid;
            $model->key = $key;
            $model->save();
        }
        return $model;
    }

    public function checkByUser($uid, $key, $entity, $entity_id)
    {
        $model = $this->findByUser($uid, $key);
        if(array_key_exists($entity . '_' . $entity_id, $model->entity))
            return true;
        return false;
    }

    public function saveByUser($uid, $key, $entity, $entity_id)
    {
        $model = $this->findByUser($uid, $key);
        $model->entity[$entity . '_' . $entity_id] = true;
        $model->save();
    }
}
