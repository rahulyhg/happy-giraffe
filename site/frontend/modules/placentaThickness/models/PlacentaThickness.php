<?php

/**
 * This is the model class for table "placentaThickness".
 *
 * The followings are the available columns in table 'placentaThickness':
 * @property integer $id
 * @property integer $week
 * @property double $min
 * @property double $avg
 * @property double $max
 */
class PlacentaThickness extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PlacentaThickness the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'placenta_thickness';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('week, min, avg, max', 'required'),
			array('week', 'numerical', 'integerOnly'=>true),
			array('min, avg, max', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, week, min, avg, max', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'week' => 'Неделя',
			'min' => 'Минимальная толщина',
			'avg' => 'Нормальная толщина',
			'max' => 'Максимальная толщина',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('week',$this->week);
		$criteria->compare('min',$this->min);
		$criteria->compare('avg',$this->avg);
		$criteria->compare('max',$this->max);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}