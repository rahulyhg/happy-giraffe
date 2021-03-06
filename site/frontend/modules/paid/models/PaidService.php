<?php

namespace site\frontend\modules\paid\models;
use site\frontend\modules\paid\values\PaidType;

/**
 * @property int $id
 * @property int $price
 * @property string $name
 * @property int $type
 * @property int $value
 */
class PaidService extends \HActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'paid_services';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [

        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [

        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'name' => 'Name',
            'type' => 'Type',
            'value' => 'Value',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaidService the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Return modified price value.
     *
     * @return int
     */
    public function getOutputPrice()
    {
        switch ($this->type) {
            case PaidType::FIXED:
                return $this->value;
            case PaidType::PERCENT:
                return $this->price - (($this->price * $this->value) / 100);
            case PaidType::PRICE_DIFF:
                return $this->price - $this->value;
        }
    }
}