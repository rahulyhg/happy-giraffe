<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mikita
 * Date: 20/02/14
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

class RegisterWidget extends CWidget
{
    public function run()
    {
        Yii::app()->clientScript->registerPackage('ko_registerWidget');
        $model = new User();
        $this->render('RegisterWidget', compact('model'));
    }
}