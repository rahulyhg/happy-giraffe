<?php
/**
 * Created by PhpStorm.
 * User: mikita
 * Date: 12/09/14
 * Time: 14:47
 */

namespace site\frontend\modules\photo\components;
use site\frontend\modules\photo\models\PhotoAttach;
use site\frontend\modules\photo\models\PhotoCollection;

class PhotoCollectionObserver extends \CComponent implements \ArrayAccess
{
    const COUNT_THRESHOLD = 50;

    public $model;

    public function __construct(PhotoCollection $model)
    {
        $this->model = $model;
    }

    public function offsetSet($offset, $value)
    {
        $this->model->attaches[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->model->attaches[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->model->attaches[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->model->attaches[$offset];
    }

    public function slice($offset, $length)
    {

    }

    protected function fetchSingle($offset)
    {
        $criteria = $this->getDefaultCriteria();
        $criteria->offset = $offset;
        return PhotoAttach::model()->find($criteria);
    }

    protected function fetchMultiple($offset, $length)
    {
        $criteria = $this->getDefaultCriteria();
        $criteria->offset = $offset;
        $criteria->limit = $length;
        return PhotoAttach::model()->findAll($criteria);

    }

    protected function getDefaultCriteria()
    {
        $criteria = new \CDbCriteria();
        $criteria->order = 't.position DESC, t.id DESC';
        return $criteria;
    }
} 