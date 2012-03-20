<?php
/**
 * Author: alexk984
 * Date: 13.03.12
 */
class AssignsCommand extends CConsoleCommand
{

    public function beforeAction($action,$params)
    {
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        return parent::beforeAction($action,$params);
    }

    /**
     * Удаление в назначениях прав несуществующих юзеров
     */
    public function actionIndex()
    {
        $models = AuthAssignment::model()->findAll();
        foreach($models as $model) {
            $count = User::model()->countByAttributes(array('id'=>$model->userid));
            if ($count == 0) {
                echo "id = {$model->userid} user not exist \n\r";
                $model->delete();
            }
        }
    }
}

