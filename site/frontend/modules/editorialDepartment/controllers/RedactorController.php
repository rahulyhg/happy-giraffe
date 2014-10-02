<?php

namespace site\frontend\modules\editorialDepartment\controllers;

/**
 * Description of RedactorController
 *
 * @author Кирилл
 */
class RedactorController extends \LiteController
{

    public function actionIndex($clubId)
    {
        $model = new \site\frontend\modules\editorialDepartment\models\Content();
        $model->clubId = $clubId;
        
        if(isset($_POST['Content']))
        {
            $model->setAttributes($_POST['Content'], false);
            echo "<pre>" . var_export($model->toArray(), true) . "</pre>";die;
        }
        
        $this->render('index', array('model' => $model));
    }

}

?>
