<?php

namespace site\frontend\modules\seo\models;

/**
 * This is the model class for table "seo__yandex_original_texts".
 *
 * The followings are the available columns in table 'seo__yandex_original_texts':
 * @property string $id
 * @property string $entity
 * @property string $entity_id
 * @property string $added
 * @property string $full_text
 * @property string $external_text
 * @property string $external_id
 * @property string $created
 * @property string $updated
 * @property integer $priority
 */
class SeoYandexOriginalText extends \CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seo__yandex_original_texts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('priority', 'numerical', 'integerOnly'=>true),
			array('entity', 'length', 'max'=>255),
			array('entity_id', 'length', 'max'=>11),
			array('external_id', 'length', 'max'=>32),
			array('added, full_text, external_text, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, entity, entity_id, added, full_text, external_text, external_id, created, updated, priority', 'safe', 'on'=>'search'),
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
			'entity' => 'Entity',
			'entity_id' => 'Entity',
			'added' => 'Added',
			'full_text' => 'Full Text',
			'external_text' => 'External Text',
			'external_id' => 'External',
			'created' => 'Created',
			'updated' => 'Updated',
			'priority' => 'Priority',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return \CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new \CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('entity',$this->entity,true);
		$criteria->compare('entity_id',$this->entity_id,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('full_text',$this->full_text,true);
		$criteria->compare('external_text',$this->external_text,true);
		$criteria->compare('external_id',$this->external_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('priority',$this->priority);

		return new \CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeoYandexOriginalText the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'setUpdateOnCreate' => true,
            )
        );
    }

    public function scopes()
    {
        return array(
            'pending' => array(
                'condition' => 'added IS NULL',
                'order' => 'priority DESC, id DESC',
                'limit' => 150,
            ),
        );
    }

    /**
     * @param \HActiveRecord|\IPreview $contentModel
     */
    public static function getAttributesByModel(\HActiveRecord $contentModel)
    {
        return array(
            'entity' => $contentModel->getEntityName(),
            'entity_id' => $contentModel->primaryKey,
            'full_text' => $contentModel->getPreviewText(),
        );
    }
}