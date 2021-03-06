<?php

/**
 * This is the model class for table "recipe_book__recipes_ingredients".
 *
 * The followings are the available columns in table 'recipe_book__recipes_ingredients':
 * @property string $id
 * @property string $recipe_id
 * @property string $unit_id
 * @property string $ingredient_id
 * @property string $value
 * @property string $display_value
 *
 * The followings are the available model relations:
 * @property RecipeBookIngredients $ingredient
 * @property RecipeBookRecipes $recipe
 * @property RecipeBookUnits $unit
 */
class RecipeBookRecipeIngredient extends HActiveRecord
{
    public $title;
    const EMPTY_INGREDIENT_UNIT = 4;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RecipeBookRecipeIngredient the static model class
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
		return 'recipe_book__recipes_ingredients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('recipe_id, ingredient_id, unit_id, value, display_value', 'required'),
            array('recipe_id', 'exist', 'attributeName' => 'id', 'className' => 'RecipeBookRecipe'),
            array('ingredient_id', 'exist', 'attributeName' => 'id', 'className' => 'RecipeBookIngredient'),
            array('unit_id', 'exist', 'attributeName' => 'id', 'className' => 'RecipeBookUnit'),
            array('value', 'numerical', 'min' => '0.01', 'max' => '9999.99', 'message'=>'Количество ингридиента должно быть числом'),
            array('title', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, recipe_id, unit_id, ingredient_id, value, display_value', 'safe', 'on'=>'search'),
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
			'ingredient' => array(self::BELONGS_TO, 'RecipeBookIngredient', 'ingredient_id'),
			'recipe' => array(self::BELONGS_TO, 'RecipeBookRecipe', 'recipe_id'),
			'unit' => array(self::BELONGS_TO, 'RecipeBookUnit', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'recipe_id' => 'Recipe',
			'unit_id' => 'Unit',
			'ingredient_id' => 'Ingredient',
			'value' => 'Количество ингридиента',
			'display_value' => 'Display Value',
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
		$criteria->compare('recipe_id',$this->recipe_id,true);
		$criteria->compare('unit_id',$this->unit_id,true);
		$criteria->compare('ingredient_id',$this->ingredient_id,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('display_value',$this->display_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getEmptyModel($n = false)
    {
        $defaultUnit = RecipeBookUnit::model()->findByPk(self::EMPTY_INGREDIENT_UNIT);
        $model = new self;
        $model->unit = $defaultUnit;
        $model->unit_id = $defaultUnit->id;
        if ($n) {
            $models = array();
            for ($i = 0; $i < $n; $i++) {
                $models[] = $model;
            }
            return $models;
        } else {
            return $model;
        }
    }

    public function setValue()
    {
        $this->value = $this->display_value;

        if (strpos($this->value, '/')) {
            $a = explode('/', $this->value);
            $this->value = $a[0] / $a[1];
        }

        if (strpos($this->value, ',')) {
            $this->value = str_replace(',', '.', $this->value);
        }
    }

    protected function afterFind()
    {
        parent::afterFind();

        $this->title = $this->ingredient->title;
    }

    public function getNoun()
    {
        return ((int) $this->value == $this->value) ?
            Str::GenerateNoun(array($this->unit->title, $this->unit->title2, $this->unit->title3), (int) $this->value)
            :
            $this->unit->title2;
    }
}