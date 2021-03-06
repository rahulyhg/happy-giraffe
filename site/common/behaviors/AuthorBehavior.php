<?php

namespace site\common\behaviors;

class AuthorBehavior extends \CActiveRecordBehavior
{
    public $attr = 'author_id';

    public function attach($owner)
    {
        $this->addAuthorRelation($owner);
        parent::attach($owner);
    }

    public function beforeValidate($event)
    {
        if (!$this->owner->hasAttribute($this->attr)) {
            throw new \CException('Attribute is invalid');
        }

        if ($this->owner->{$this->attr} === null) {
            if (\Yii::app()->user->isGuest) {
                throw new \CException('User must be authenticated');
            }
            $this->owner->{$this->attr} = \Yii::app()->user->id;
        }
    }

    public function getAuthorId()
    {
        return $this->owner->{$this->attr};
    }

    /**
     * @param $owner \HActiveRecord
     */
    protected function addAuthorRelation($owner)
    {
        if (!$owner->getMetaData()->hasRelation('author')) {
            $owner->getMetaData()->addRelation('author', array(
                \CActiveRecord::BELONGS_TO,
                '\User',
                $this->attr,
            ));
        }
    }
} 