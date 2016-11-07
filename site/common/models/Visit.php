<?php

/**
 * This is the model class for table "visits".
 *
 * The followings are the available columns in table 'visits':
 * @property string $id
 * @property string $user_id
 * @property string $url
 * @property string $last_visit
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Visit extends HActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Visit the static model class
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
        return 'visits';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, url', 'required'),
            array('user_id', 'length', 'max'=>11),
            array('url', 'length', 'max'=>2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, url, last_visit', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'url' => 'Url',
            'last_visit' => 'Last Visit',
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
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('last_visit',$this->last_visit,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'last_visit',
                'updateAttribute' => 'last_visit',
            ),
        );
    }

    /**
     * @static
     * @return bool
     */
    public static function processVisit()
    {
        if (Yii::app()->user->isGuest)
            return false;

        $userId = Yii::app()->user->id;
        $url = Yii::app()->request->url;

        $visit = self::model()->findByAttributes(array('user_id' => $userId, 'url' => $url));
        if ($visit === null) {
            $visit = new self();
            $visit->user_id = $userId;
            $visit->url = $url;
        }
        return $visit->save();
    }
}