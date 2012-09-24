<?php
/**
 * Created by JetBrains PhpStorm.
 * User: solivager
 * Date: 9/21/12
 * Time: 11:57 AM
 * To change this template use File | Settings | File Templates.
 */
class SettingsController extends HController
{
    public $user;

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CaptchaAction',
                'backColor' => 0xFFFFFF,
                'width' => 125,
                'height' => 46,
                'onlyDigits' => true,
            ),
        );
    }

    public function filters()
    {
        return array(
            'ajaxOnly + index, changePassword',
        );
    }

    public function init()
    {
        $this->user = Yii::app()->user->model;
    }

    public function actionIndex()
    {
        $this->renderPartial('index', null, false, true);
    }

    public function actionChangePassword()
    {
        $model = Yii::app()->user->model;
        $model->scenario = 'change_password';
        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate(array('current_password', 'new_password', 'new_password_repeat', 'verifyCode'))) {
                $model->password = $model->new_password;
                echo CJavaScript::encode($model->update(array('password')));
            }
        }
    }

    public function actionRemove()
    {
        $this->user->deleted = 1;
        $this->user->update(array('deleted'));
        Yii::app()->user->logout();
        $this->redirect('/');
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='password-form')
        {
            echo CActiveForm::validate($model, array('current_password', 'new_password', 'new_password_repeat', 'verifyCode'));
            Yii::app()->end();
        }
    }
}
