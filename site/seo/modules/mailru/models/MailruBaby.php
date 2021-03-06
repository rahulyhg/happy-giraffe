<?php

/**
 * This is the model class for table "mailru__babies".
babies".
 *
 * The followings are the available columns in table 'mailru__babies':
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $birthday
 * @property integer $gender
 *
 * The followings are the available model relations:
 * @property MailruUser $parent
 */
class MailruBaby extends HActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MailruBaby the static model class
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
        return 'mailru__babies';
    }

    public function getDbConnection()
    {
        return Yii::app()->db_seo;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, name, gender', 'required'),
            array('gender', 'numerical', 'integerOnly'=>true),
            array('parent_id', 'length', 'max'=>10),
            array('name', 'length', 'max'=>255),
            array('birthday', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, name, birthday, gender', 'safe', 'on'=>'search'),
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
            'parent' => array(self::BELONGS_TO, 'MailruUser', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'name' => 'Name',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('parent_id',$this->parent_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('gender',$this->gender);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}