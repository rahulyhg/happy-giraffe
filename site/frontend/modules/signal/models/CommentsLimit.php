<?php

class CommentsLimit extends EMongoDocument
{
    public $entity;
    public $entity_id;
    public $limit;
    public $comment_times = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getCollectionName()
    {
        return 'comments_limit';
    }

    public function getMongoDBComponent()
    {
        return Yii::app()->getComponent('mongodb_production');
    }

    /**
     * @static
     * @param string $entity
     * @param int $entity_id
     * @param array|int $limit
     * @param array $timings
     * @return int
     */
    public static function getLimit($entity, $entity_id, $limit, $timings)
    {
        $criteria = new EMongoCriteria;
        $criteria->entity('==', $entity);
        $criteria->entity_id('==', (int)$entity_id);
        $model = self::model()->find($criteria);

        if ($model === null) {
            $model = new CommentsLimit();
            $model->entity = $entity;
            $model->entity_id = (int)$entity_id;
            if (is_array($limit) && count($limit) > 1)
                $model->limit = rand($limit[0], $limit[1]);
            else {
                if (is_array($limit))
                    $limit = $limit[0];
                $model->limit = rand(round($limit - $limit / 8), round($limit + $limit / 8));
            }

            $model->comment_times = self::generateTimes($timings);
            $model->save();
        } elseif (empty($model->comment_times)) {
            $model->comment_times = self::generateTimes($timings);
            $model->save();
        }

        //update limit if needed
        if (is_array($limit) && count($limit) > 1){
            if ($model->limit < $limit[0]){
                $model->limit = rand($limit[0], $limit[1]);
                $model->save();
            }
        }
        else {
            if (is_array($limit))
                $limit = $limit[0];
            if ($model->limit < round($limit - $limit / 8)){
                $model->limit = rand(round($limit - $limit / 8), round($limit + $limit / 8));
                $model->save();
            }
        }


        return array($model->limit, $model->comment_times);
    }

    public function generateTimes($timings)
    {
        $periods = array(0, 60, 180, 360, 2880);
        $result = array();
        for ($i = 0; $i < count($timings); $i++) {
            for ($j = 0; $j < $timings[$i]; $j++)
                $result[] = $periods[$i] + rand($periods[$i], $periods[$i + 1]);
        }

        sort($result);
        return $result;
    }
}
