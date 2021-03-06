<?php

class CookUnit extends HActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CookUnit the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cook__units';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, type, ratio', 'required'),
            array('title, title2, title3, type', 'length', 'max' => 255),
            array('ratio', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, title2, title3, type, ratio', 'safe', 'on' => 'search'),
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
            'cookIngredients' => array(self::HAS_MANY, 'CookIngredient', 'default_unit_id'),
            'ingredientUnits' => array(self::HAS_MANY, 'CookIngredientUnit', 'unit_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название (1 ...)',
            'title2' => 'Название (2 ...)',
            'title3' => 'Название (5 ...)',
            'type' => 'Тип',
            'ratio' => 'Вес',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('title2', $this->title2, true);
        $criteria->compare('title3', $this->title3, true);
        $criteria->compare('type', 'qty');
        $criteria->compare('ratio', $this->ratio, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getUnits()
    {
        $result = array();
        $units = self::model()->findAll(array('order' => 'title'));
        foreach ($units as $unit)
            $result [$unit->id] = $unit->title;
        return $result;
    }

    public function getTypesData()
    {
        $result = array();
        $units = self::model()->findAll();
        foreach ($units as $unit) {
            $result[$unit->id] = array(
                'data-type' => $unit->type,
                'data-ratio' => $unit->ratio
            );
        }
        return $result;
    }

}