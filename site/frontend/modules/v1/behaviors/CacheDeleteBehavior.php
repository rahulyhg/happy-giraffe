<?php

namespace site\frontend\modules\v1\behaviors;

use site\frontend\modules\v1\components\V1ApiController;
use site\frontend\modules\v1\helpers\ApiLog;

/**
 * Checks key collection in cache and delete keys which contains owner model.
 */
class CacheDeleteBehavior extends \CActiveRecordBehavior
{
    public function afterSave($event)
    {
        parent::afterSave($event);

        $this->handleCollection();
    }

    public function beforeDelete($event)
    {
        parent::beforeDelete($event);

        $this->handleCollection();
    }

    private function handleCollection()
    {
        try {
            $collection = \Yii::app()->cache->get(V1ApiController::KEYS_COLLECTION);

            if (!$collection) {
                return;
            }

            $collection = array_filter($collection);
            $collection = array_values($collection);

            ApiLog::i("Before Cache Clear: " . print_r($collection, true));

            $owner = get_class($this->owner);
            $total = count($collection);

            for ($i = 0; $i < $total; $i++) {
                $key = json_decode($collection[$i]);

                if (strstr($key->model, $owner)) {
                    \Yii::app()->cache->delete($collection[$i]);
                    unset($collection[$i]);
                } else if (isset($key->expand_models)) {
                    foreach ($key->expand_models as $expand_model) {
                        if (strstr($expand_model, $owner)) {
                            \Yii::app()->cache->delete($collection[$i]);
                            unset($collection[$i]);
                        }
                    }
                }
            }

            ApiLog::i("After Cache Clear: " . print_r($collection, true));

            \Yii::app()->cache->set(V1ApiController::KEYS_COLLECTION, $collection, V1ApiController::CACHE_COLLECTION_EXPIRE);
        } catch (Exception $ex) {
            //Emergency fix.
            ApiLog::i("WE ALL DIE!");
            \Yii::app()->cache->flush();
        }
    }
}