<?php

namespace site\frontend\modules\users\models;
\Yii::import('site.common.models.User', true);
/**
 * Description of User
 *
 * @author Кирилл
 */
class User extends \User implements \IHToJSON
{
    private $_specInfo;

    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;

    public function rules()
    {
        return array(
            array('specInfo', 'filter', 'filter' => array($this->specInfoObject, 'serialize')),
            array('first_name, last_name', 'length', 'max' => 50),
            array('birthday', 'date', 'format' => 'yyyy-M-d'),
            array('gender', 'in', 'range' => array(self::GENDER_FEMALE, self::GENDER_MALE)),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function toJSON()
    {
        return array(
            'id' => (int) $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'birthday' => $this->birthday,
            'avatarId' => (int) $this->avatar_id,
            'gender' => (int) $this->gender,
            'isOnline' => (bool) $this->online,
            'profileUrl' => $this->getUrl(true),
            'publicChannel' => $this->getPublicChannel(),
            'specInfo' => empty($this->specInfo) ? null : $this->specInfoObject,
            'avatarInfo' => \CJSON::decode($this->avatarInfo),
        );
    }

    public function getSpecInfoObject()
    {
        if (! isset($this->_specInfo))
            $this->_specInfo = new Spec($this->specInfo, $this);

        return $this->_specInfo;
    }
}
