<?php

class ETarif extends CActiveRecord {

	public function __construct($scenario='insert') {
		parent::__construct($scenario);
	}

	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, tarif_zone', 'numerical', 'integerOnly' => true),
//			array('price', 'required'),
			array('id, tarif_zone, tarif_weight1, tarif_weight2, tarif_overload, tarif_price', 'safe'),
		);
	}

	public function init() {
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Delivery the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{shop__delivery_' . __CLASS__ . '}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tarifzone' => array(self::HAS_ONE, 'ETarifZones', 'tarif_zone'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'tarif_zone' => 'Zone',
			'tarif_weight1' => 'Weight',
			'tarif_overload' => 'Overload',
			'tarif_price' => 'Price'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('tarif_zone', $this->tarif_zone, true);
		$criteria->compare('tarif_weight1', $this->tarif_weight, true);
		$criteria->compare('tarif_weight2', $this->tarif_weight, true);
		$criteria->compare('tarif_overload', $this->tarif_overload, true);
		$criteria->compare('tarif_price', $this->tarif_price, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
}

?>