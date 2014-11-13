<?php


namespace site\frontend\modules\family\models;
use site\frontend\modules\family\components\AgeHelper;
use site\frontend\modules\family\models\viewData\AdultViewData;

/**
 * @author Никита
 * @date 23/10/14
 *
 * @property \site\frontend\modules\family\models\FamilyMember $partner
 */

class Adult extends FamilyMemberAbstract
{
    const STATUS_FRIENDS = 'friends';
    const STATUS_ENGAGED = 'engaged';
    const STATUS_MARRIED = 'married';

    public $type = 'adult';
    public $relationshipStatus;

    private $_oldRelationshipStatus;

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return \CMap::mergeArray(parent::rules(), array(
            array('relationshipStatus', 'in', 'range' => array(
                self::STATUS_FRIENDS,
                self::STATUS_ENGAGED,
                self::STATUS_MARRIED,
            ), 'allowEmpty' => false, 'on' => 'insert'),
            array('relationshipStatus', 'in', 'range' => array(
                self::STATUS_FRIENDS,
                self::STATUS_ENGAGED,
                self::STATUS_MARRIED,
            ), 'on' => 'update'),
            array('name', 'length', 'max' => 50),
            array('description', 'length', 'max' => 1000),
        ));
    }

    protected function getViewDataInternal()
    {
        return new AdultViewData($this);
    }

    protected function afterFind()
    {
        if ($this->family !== null && $this->family->adultsRelationshipStatus !== null) {
            $this->relationshipStatus = $this->_oldRelationshipStatus = $this->family->adultsRelationshipStatus;
        }
    }

    protected function afterSave()
    {
        if ($this->isNewRecord || ($this->relationshipStatus != $this->_oldRelationshipStatus)) {
            $this->family->adultsRelationshipStatus = $this->relationshipStatus;
            $this->family->save();
        }
        parent::afterSave();
    }

    protected function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord && $this->scenario != 'familyCreate') {
                $this->gender = $this->getGenderByPartner();
            }
            return true;
        }
        return false;
    }

    protected function getGenderByPartner()
    {
        return ($this->partner->gender == self::GENDER_MALE) ? self::GENDER_FEMALE : self::GENDER_MALE;
    }

    protected function canBeAdded()
    {
        $adults = $this->family->getMembers(FamilyMember::TYPE_ADULT);
        return count($adults) < 2;
    }

    public function toJSON()
    {
        return \CMap::mergeArray(parent::toJSON(), array(
            'relationshipStatus' => $this->relationshipStatus,
            'name' => $this->name,
            'description' => $this->description,
            'gender' => $this->gender,
            'photoCollection' => $this->photoCollection,
        ));
    }

    public function getPartner()
    {
        $adults = $this->family->getMembers(FamilyMember::TYPE_ADULT);
        foreach ($adults as $adult) {
            if ($adult->id != $this->id) {
                return $adult;
            }
        }
        return null;
    }
} 