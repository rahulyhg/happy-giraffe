<?php

/**
 * This is the model class for table "{{community_article}}".
 *
 * The followings are the available columns in table '{{community_article}}':
 * @property string $id
 * @property string $text
 * @property string $source_type
 * @property string $internet_link
 * @property string $book_author
 * @property string $book_name
 * @property string $content_id
 */
class CommunityArticle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CommunityArticle the static model class
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
		return '{{club_community_article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, source_type, content_id', 'required'),
			array('source_type', 'length', 'max'=>8),
			array('internet_link, internet_favicon, internet_title, book_author, book_name', 'length', 'max'=>255),
			array('content_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text, source_type, internet_link, book_author, book_name, content_id', 'safe', 'on'=>'search'),
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
			'content' => array(self::BELONGS_TO, 'CommunityContent', 'content_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
			'source_type' => 'Source Type',
			'internet_link' => 'Internet Link',
			'internet_favicon' => 'Internet Favicon',
			'internet_title' => 'Internet Title',
			'book_author' => 'Book Author',
			'book_name' => 'Book Name',
			'content_id' => 'Content',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('source_type',$this->source_type,true);
		$criteria->compare('internet_link',$this->internet_link,true);
		$criteria->compare('internet_favicon',$this->internet_link,true);
		$criteria->compare('internet_title',$this->internet_link,true);
		$criteria->compare('book_author',$this->book_author,true);
		$criteria->compare('book_name',$this->book_name,true);
		$criteria->compare('content_id',$this->content_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}