<?php
/**
 * Author: alexk984
 * Date: 30.03.12
 *
 * @property User $user
 */
class FamilyController extends Controller
{
    public $user;
    public $layout = 'user';

    public function filters()
    {
        return array(
            'accessControl',
            'addBaby,removeBaby + onlyAjax'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action)
    {
        Yii::app()->clientScript->registerScriptFile('/javascripts/family.js');

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->user = User::model()->with(array(
            'babies', 'partner'
        ))->findByPk(Yii::app()->user->id);

        if ($this->user->partner == null) {
            $partner = new UserPartner();
            $partner->user_id = $this->user->id;
            $partner->save();
            $this->user->partner = $partner;
        }

        Yii::import('application.widgets.user.UserCoreWidget');
        $this->render('index', array('user' => $this->user));
    }

    public function actionAddBaby()
    {
        $name = Yii::app()->request->getPost('name');
        $model = new Baby();
        $model->parent_id = Yii::app()->user->id;
        $model->name = $name;
        if ($model->save()) {
            $response = array(
                'status' => true,
                'id' => $model->id
            );
        } else {
            $response = array(
                'status' => false,
            );
        }
        echo CJSON::encode($response);
    }

    public function actionRemoveBaby()
    {
        $ids = Yii::app()->request->getPost('ids');
//        $nums = Yii::app()->request->getPost('nums');

        foreach ($ids as $id)
            if (!empty($id)) {
                $baby = Baby::model()->findByPk($id);
                if ($baby->parent_id == Yii::app()->user->id) {
                    $baby->delete();
                    $response = array(
                        'status' => true,
                    );
                }
                else {
                    $response = array(
                        'status' => false,
                    );
                }
            }

        echo CJSON::encode($response);
    }
}
