<?php

/**
 * This is the model class for table "cook__recipes".
 *
 * The followings are the available columns in table 'cook__recipes':
 * @property string $id
 * @property string $title
 * @property string $photo_id
 * @property integer $preparation_duration
 * @property integer $cooking_duration
 * @property integer $servings
 * @property string $text
 * @property string $cuisine_id
 * @property integer $type
 * @property integer $method
 * @property string $author_id
 *
 * The followings are the available model relations:
 * @property CookRecipeIngredients[] $cookRecipeIngredients
 * @property Users $author
 * @property AlbumPhotos $photo
 * @property CookCuisines $cuisine
 */
class CookRecipe extends CActiveRecord
{
    public $types = array(
        1 => 'Первые блюда',
        2 => 'Вторые блюда',
        3 => 'Салаты',
        4 => 'Закуски и бутерброды',
        5 => 'Сладкая выпечка',
        6 => 'Несладкая выпечка',
        7 => 'Торты и пирожные',
        8 => 'Десерты',
        9 => 'Напитки',
        10 => 'Соусы и кремы',
        11 => 'Консервация',
    );

    public $methods = array(
        1 => 'Варка',
        2 => 'Жарение',
        3 => 'Запекание',
        4 => 'Тушение',
        5 => 'Копчение',
        6 => 'Вяление',
        7 => 'Маринование',
        8 => 'Соление',
        9 => 'Квашение',
        10 => 'Сушение',
        11 => 'Замораживание',
        12 => 'Выпекание',
        13 => 'На углях',
    );

    public $preparation_duration_h;
    public $preparation_duration_m;
    public $cooking_duration_h;
    public $cooking_duration_m;

    private $_nutritionals = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CookRecipe the static model class
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
		return 'cook__recipes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text, type, method, author_id, ingredients', 'required'),
            array('title', 'length', 'max' => 255),
            array('photo_id', 'exist', 'attributeName' => 'id', 'className' => 'AlbumPhoto'),
            array('cuisine_id', 'exist', 'attributeName' => 'id', 'className' => 'CookCuisine'),
            array('author_id', 'exist', 'attributeName' => 'id', 'className' => 'User'),
            array('type', 'in', 'range' => array_keys($this->types)),
            array('method', 'in', 'range' => array_keys($this->methods)),
            array('servings', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 10),
            array('preparation_duration, cooking_duration', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 999),
            array('preparation_duration_h, preparation_duration_m, cooking_duration_h, cooking_duration_m', 'safe'),
            array('cuisine_id', 'default', 'value' => null),
            array('photo_id', 'default', 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, photo_id, preparation_duration, cooking_duration, servings, text, cuisine_id, type, method, author_id', 'safe', 'on'=>'search'),
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
			'ingredients' => array(self::HAS_MANY, 'CookRecipeIngredient', 'recipe_id'),
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'photo' => array(self::BELONGS_TO, 'AlbumPhoto', 'photo_id'),
			'cuisine' => array(self::BELONGS_TO, 'CookCuisine', 'cuisine_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название блюда',
			'photo_id' => 'Фото блюда',
			'preparation_duration' => 'Время подготовки',
			'cooking_duration' => 'Время приготовления',
			'servings' => 'На сколько порций',
			'text' => 'Описание приготовления',
			'cuisine_id' => 'Кухня',
			'type' => 'Тип блюда',
			'method' => 'Способ приготовления',
			'author_id' => 'Автор',

            'ingredients' => 'Из чего готовим?',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('photo_id',$this->photo_id,true);
		$criteria->compare('preparation_duration',$this->preparation_duration);
		$criteria->compare('cooking_duration',$this->cooking_duration);
		$criteria->compare('servings',$this->servings);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('cuisine_id',$this->cuisine_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('method',$this->method);
		$criteria->compare('author_id',$this->author_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function behaviors()
    {
        return array(
            'withRelated'=>array(
                'class'=>'site.common.extensions.wr.WithRelatedBehavior',
            ),
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
            ),
        );
    }

    protected function beforeValidate() {
        if (! empty($this->preparation_duration_h) || ! empty($this->preparation_duration_m)) {
            $this->preparation_duration = $this->preparation_duration_h * 60 + $this->preparation_duration_m;
        } else {
            $this->preparation_duration = null;
        }
        if (! empty($this->cooking_duration_h) || ! empty($this->cooking_duration_m)) {
            $this->cooking_duration = $this->cooking_duration_h * 60 + $this->cooking_duration_m;
        } else {
            $this->cooking_duration = null;
        }

        return parent::beforeValidate();
    }

    protected function afterFind()
    {
        $this->preparation_duration_h = sprintf("%02d", floor($this->preparation_duration / 60));
        $this->preparation_duration_m = sprintf("%02d", $this->preparation_duration % 60);
        $this->cooking_duration_h = sprintf("%02d", floor($this->cooking_duration / 60));
        $this->cooking_duration_m = sprintf("%02d", $this->cooking_duration % 60);

        parent::afterFind();
    }

    protected function beforeSave()
    {
        if (! $this->isNewRecord) {
            CookRecipeIngredient::model()->deleteAll('recipe_id = :recipe_id', array(':recipe_id' => $this->id));
        }

        return parent::beforeSave();
    }

    public function getNutritionals()
    {
        if ($this->_nutritionals === null) {
            $ingredients = array();
            foreach ($this->ingredients as $ingredient) {
                $ingredients[] = array(
                    'ingredient_id' => $ingredient->ingredient_id,
                    'unit_id' => $ingredient->unit_id,
                    'value' => $ingredient->value
                );
            }
            $converter = new CookConverter();
            $this->_nutritionals = $converter->calculateNutritionals($ingredients);
        }

        return $this->_nutritionals;
    }

    public function findByIngredients($ingredients, $type = null)
    {
        $subquery = Yii::app()->db->createCommand()
            ->select('count(*)')
            ->from('cook__recipe_ingredients')
            ->where(array('and', 'recipe_id = t.id', array('in', 'cook__recipe_ingredients.ingredient_id', $ingredients)))
            ->text;

        $criteria = new CDbCriteria;
        $criteria->condition = '(' . $subquery . ') = :count';
        $criteria->params = array(':count' => count($ingredients));
        if ($type !== null)
            $criteria->compare('type', $type);

        return $this->findAll($criteria);
    }

    public function getUrl()
    {
        return Yii::app()->controller->createUrl('/cook/recipe/view', array('id' => $this->id));
    }

    public function getPreview($imageWidth = 167)
    {
        if ($this->photo !== null) {
            $preview = CHtml::link(CHtml::image($this->photo->getPreviewUrl($imageWidth, null, Image::WIDTH)), $this->url);
        } else {
            $preview = CHtml::tag('p', array(), Str::truncate($this->text));
        }

        return $preview;
    }

    public function getMore()
    {
        $next = $this->findAll(
            array(
                'condition' => 't.id > :current_id',
                'params' => array(':current_id' => $this->id),
                'limit' => 1,
                'order' => 't.id',
            )
        );

        $prev = $this->findAll(
            array(
                'condition' => 't.id < :current_id',
                'params' => array(':current_id' => $this->id),
                'limit' => 2,
                'order' => 't.id DESC',
            )
        );

        return CMap::mergeArray($next, $prev);
    }
}
