<?php
/**
 * Поведение для моделей, имеющих коллекцию
 *
 * Создает relation для связи с коллекцией
 */

namespace site\frontend\modules\photo\components;

class PhotoCollectionBehavior extends \CActiveRecordBehavior
{
    /**
     * @param \HActiveRecord $owner
     */
    public function attach($owner)
    {
        $class = \CActiveRecord::HAS_ONE;
        $relationName = 'photoCollection';
        $owner->getMetaData()->relations[$relationName] =
            new $class($relationName,
                'site\frontend\modules\photo\models\PhotoCollection',
                'entity_id',
                array('condition' => 'entity = :entity', 'params' => array(':entity' => $owner->getEntityName()))
            );
    }
} 