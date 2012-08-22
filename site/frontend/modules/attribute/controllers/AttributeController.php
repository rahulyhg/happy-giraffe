<?php

class AttributeController extends HController
{
	public $defaultAction = 'admin';

	/**
	 * @var string the default layout for the views_old. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views_old/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
				'users' => array('*'),
			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$attribytes = array();
		//string
		if($model->attribute_type == 1)
		{
			$att_v = new AttributeValue;
			$att_v_m = new AttributeValueMap;

			$rawData = Yii::app()->db->createCommand()
					->select('map_attribute_id AS id, value_id, map_id, value_value')
					->from($att_v_m->tableName())
					->leftJoin($att_v->tableName(), 'map_value_id=value_id')
					->where('map_attribute_id=:map_attribute_id',array(
						':map_attribute_id' => $model->attribute_id,
					))
					->queryAll();

			$attribytes = new CArrayDataProvider($rawData, array(
						'id' => 'attributes',
						'sort' => array(
							'attributes' => array(
								'id', 'value_value'
							),
						),
						'pagination' => array(
							'pageSize' => 10,
						),
					));
		}

		$this->render('view', array(
			'model' => $model,
			'attribytes' => $attribytes,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Attribute;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Attribute']))
		{
			$model->attributes = $_POST['Attribute'];
			if($model->save())
				$this->redirect(array('view', 'id' => $model->attribute_id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Attribute']))
		{
			$model->attributes = $_POST['Attribute'];
			if($model->save())
				$this->redirect(array('view', 'id' => $model->attribute_id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Attribute');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Attribute('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attribute']))
			$model->attributes = $_GET['Attribute'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 * @return Attribute
	 */
	public function loadModel($id)
	{
		$model = Attribute::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'product-attribute-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
