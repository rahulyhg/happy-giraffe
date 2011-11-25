<?php

class CategoryController extends AController
{
	public $CQtreeGreedView  = array (
        'modelClassName' => 'Category', //название класса
        'adminAction' => 'admin', //action, где выводится QTreeGridView. Сюда будет идти редирект с других действий.
    );

	public function actions() {
        return array (
            'create'=>'ext.QTreeGridView.actions.Create',
            'update'=>'ext.QTreeGridView.actions.Update',
            'delete'=>'ext.QTreeGridView.actions.Delete',
            'moveNode'=>'ext.QTreeGridView.actions.MoveNode',
            'makeRoot'=>'ext.QTreeGridView.actions.MakeRoot',
        );
    }

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','new'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','moveNode','makeRoot','root','up','down','connectAttributes','connectAttributesSet','attributeList','attributeListSet','unconnectAttribute','addAttributeInSearch','remAttributeInSearch','attributeInSearch'),
//				'users'=>array('@'),
				'roles'=>array('admin'),
				'roles'=>array('guest'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAttributeInSearch($id)
	{
		if(!isset($_POST['insearch']))
		{
			Y::command()
				->update('shop_category_attributes_map', array(
					'map_in_search'=>0,
				), 'map_category_id=:map_category_id', array(
					':map_category_id'=>$id,
				));
			
			Y::successFlash('All deleted');
			$this->redirect(Y::request()->urlReferrer);
		}
		
		$map = Y::command()
			->select('map_attribute_id')
			->from('shop_category_attributes_map')
			->where('map_category_id=:map_category_id AND map_in_search=1', array(
				':map_category_id'=>$id,
			))
			->group('map_attribute_id')
			->queryAll(false);
		
		$map = CHtml::listData($map, 0, 0);
		
//		Y::dump($_POST['insearch'], false);
//		Y::dump($map, false);
		
		$to_del = array_diff($map, $_POST['insearch']);
		$to_ins = array_diff($_POST['insearch'], $map);
		
//		Y::dump($to_ins, false);
//		Y::dump($to_del);
		
		if($to_ins)
		{
			$exist = Y::command()
				->select('COUNT(*)')
				->from('shop_product_attribute')
				->where(array('in','attribute_id',$to_ins))
				->queryScalar();

			if(count($to_ins) != $exist)
			{
				Y::errorFlash('Hack');
				$this->redirect(Y::request()->urlReferrer);
			}
			Y::command()
				->update('shop_category_attributes_map', array(
					'map_in_search'=>1,
				), array('and',array('in','map_attribute_id',$to_ins),'map_category_id=:map_category_id'),array(
					':map_category_id'=>$id,
				));
		}
		
		if($to_del)
		{
//			Y::dump($to_del);
			Y::command()
				->update('shop_category_attributes_map', array(
					'map_in_search'=>0,
				), array('and',array('in','map_attribute_id',$to_del),'map_category_id=:map_category_id'),array(
					':map_category_id'=>$id,
				));
		}
		
		Y::successFlash('All saved');
		$this->redirect(Y::request()->urlReferrer);
	}
	
	public function actionUnconnectAttribute($id,$categiry_id)
	{
		if(Y::isPostRequest())
		{
			Y::command()
				->delete('shop_category_attributes_map', 'map_category_id=:map_category_id AND map_attribute_id=:map_attribute_id', array(
					':map_category_id'=>$categiry_id,
					':map_attribute_id'=>$id,
				));
			
			if(!Y::isAjaxRequest())
				Y::redir(array('view', 'id'=>$categiry_id));
		}
	}
	
	/**
	 * @param int $id attribute ID
	 * @param int $categiry_id category ID
	 */
	public function actionAddAttributeInSearch($id, $categiry_id)
	{
		Y::command()
			->update('shop_category_attributes_map', array(
				'map_in_search'=>1,
			), 'map_category_id=:map_category_id AND map_attribute_id=:map_attribute_id', array(
				':map_category_id'=>$categiry_id,
				':map_attribute_id'=>$id,
			));
		
		if(Y::isAjaxRequest())
			Y::end('Ok');
		
		$this->redirect(array('view','id'=>$categiry_id));
	}
	
	/**
	 * @param int $id attribute ID
	 * @param int $categiry_id category ID
	 */
	public function actionRemAttributeInSearch($id, $categiry_id)
	{
		Y::command()
			->update('shop_category_attributes_map', array(
				'map_in_search'=>0,
			), 'map_category_id=:map_category_id AND map_attribute_id=:map_attribute_id', array(
				':map_category_id'=>$categiry_id,
				':map_attribute_id'=>$id,
			));
		
		if(Y::isAjaxRequest())
			Y::end('Ok');
		
		$this->redirect(array('view','id'=>$categiry_id));
	}


	/**
	 * 
	 * @param int $id category ID
	 */
	public function actionConnectAttributes($id)
	{
		if(isset($_POST['attribute_id']))
		{
			$sql = "INSERT IGNORE INTO shop_category_attributes_map (map_category_id, map_attribute_id)
				VALUES(:map_category_id, :map_attribute_id)";
			Y::command($sql)->execute(array(
				':map_category_id'=>(int) $id,
				':map_attribute_id'=>(int) $_POST['attribute_id'],
			));
			Y::redir(array('view', 'id'=>$id));
		}
		
		if(Y::isAjaxRequest())
			$this->layout = 'empty';

		$this->render('connectAttributes',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * 
	 * @param int $id category ID
	 */
	public function actionConnectAttributesSet($id)
	{
		if(isset($_POST['set_id']))
		{
			$sql = "INSERT IGNORE INTO shop_category_attributes_map (map_category_id, map_attribute_id)
				SELECT $id, map_attribute_id FROM shop_product_attribute_set_map
					WHERE map_set_id=:map_set_id";
			Y::command($sql)->execute(array(
				':map_set_id'=>(int) $_POST['set_id'],
			));
			Y::redir(array('view', 'id'=>$id));
		}
		
		if(Y::isAjaxRequest())
			$this->layout = 'empty';

		$this->render('connectAttributesSet',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionAttributeListSet($term='')
	{
		Yii::import('attribute.models.AttributeSet');
		$sets = AttributeSet::model()->listAll($term, array('set_title','set_text'));
		foreach($sets as $k=>$v)
		{
			$sets[$k]['value']=$v['set_title'];
		}
		
		if(!$sets)
			$sets[] = array(
				'set_id'=>0,
				'set_title'=>'Not found',
				'set_text'=>'',
				'value'=>'Not found',
			);
		
		Y::endJson($sets);
	}
	
	public function actionAttributeList($term='')
	{
		Yii::import('attribute.models.Attribute');
		$sets = Attribute::model()->listAll($term, array('attribute_title','attribute_text'));
		foreach($sets as $k=>$v)
		{
			$sets[$k]['value']=$v['set_title'];
		}
		
		if(!$sets)
			$sets[] = array(
				'attribute_id'=>0,
				'attribute_title'=>'Not found',
				'attribute_text'=>'',
				'value'=>'Not found',
			);
		
		Y::endJson($sets);
	}

	public function actionUp($id)
	{
		$model = $this->loadModel($id);
		$prevSubling = $model->prevSibling;

		if(!$prevSubling)
			Y::errorFlash('This category is first');
		else
			$model->moveBefore($prevSubling);

		$this->redirect(array('admin'));
	}

	public function actionDown($id)
	{
		$model = $this->loadModel($id);
		$nextSubling = $model->nextSibling;

		if(!$nextSubling)
			Y::errorFlash('This category is last');
		else
			$model->moveAfter($nextSubling);

		$this->redirect(array('admin'));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$id = (int) $id;
		
		$model = $this->loadModel($id);
		
		$attridute_ids = Y::command()
			->select('map_attribute_id')
			->from('shop_category_attributes_map')
			->where('map_category_id=:map_category_id', array(
				':map_category_id'=>$id,
			))
			->queryAll();
		
		/**
		 * ---------------------------------------------------------------------
		 */
		$parents = Y::command()
			->select('category_id, category_name')
			->from($model->tableName())
			->where('category_lft<:category_lft AND category_rgt>:category_rgt', array(
				':category_lft'=>$model->category_lft,
				':category_rgt'=>$model->category_rgt,
			))
			->queryAll();
		$parents = CHtml::listData($parents, 'category_id', 'category_name');
		
		$descendants = Y::command()
			->select('category_id, category_name')
			->from($model->tableName())
			->where('category_lft>=:category_lft AND category_rgt<=:category_rgt', array(
				':category_lft'=>$model->category_lft,
				':category_rgt'=>$model->category_rgt,
			))
			->queryAll();
		$descendants = CHtml::listData($descendants, 'category_id', 'category_name');
		
		$criteria = new CDbCriteria;
		$criteria->addInCondition('product_category_id', array_keys($descendants));
		
//		$this->getFilter($criteria, $descendants, $id);
		
		$sort = new CSort;
		$sort->modelClass = 'Product';
		$sort->attributes = array(
			'product_price',
			'product_time',
			'product_rate',
			'product_title',
		);
		
		$products = new CActiveDataProvider('Product', array(
			'criteria' => $criteria,
			'sort' => $sort,
			'pagination' => array(
					'pageSize' => 20,
				),
			));
		/**
		 * ---------------------------------------------------------------------
		 */
		
		Yii::import('attribute.models.Attribute');
		$attributes=new Attribute('search');
		$attributes->unsetAttributes();  // clear any default values
		if(isset($_GET['Attribute']))
		{
			$attributes->attributes=$_GET['Attribute'];
		}
		
		$criteria = new CDbCriteria;
		
		if($attridute_ids)
		{
			$attridute_ids = CHtml::listData($attridute_ids, 'map_attribute_id', 'map_attribute_id');

			$criteria->addInCondition('attribute_id', $attridute_ids);
		}else
			$criteria->condition = 'attribute_id=0';
		
		$render = Y::isAjaxRequest()
			? 'renderPartial'
			: 'render';
		
		$this->$render('view',array(
			'model'=>$model,
			'attrs'=>$attributes,
			'criteria'=>$criteria,
			'parents'=>$parents,
			'products'=>$products,
			'descendants'=>$descendants,
			'sort'=>$sort,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRoot()
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->saveNode())
				$this->redirect(array('view','id'=>$model->category_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			$parent = $this->loadModel($id);
			if($model->appendTo($parent))
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save())
				$this->redirect(array('view'));
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
			$this->loadModel($id)->tree->delete();

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
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 * @return Category
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
