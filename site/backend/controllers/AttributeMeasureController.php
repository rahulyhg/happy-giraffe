<?php

class AttributeMeasureController extends BController
{
    public $layout = 'shop';
    public $defaultAction = 'admin';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

    public function beforeAction($action)
    {
        if (!Yii::app()->user->checkAccess('shop'))
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return true;
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AttributeMeasure;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AttributeMeasure']))
		{
			$model->attributes=$_POST['AttributeMeasure'];
			if($model->save())
                $this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AttributeMeasure']))
		{
			$model->attributes=$_POST['AttributeMeasure'];
			if($model->save())
                $this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AttributeMeasure('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AttributeMeasure']))
			$model->attributes=$_GET['AttributeMeasure'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AttributeMeasure::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
    public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='attribute-measure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}