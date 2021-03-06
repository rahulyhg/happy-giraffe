<?php
/**
 * @author Никита
 * @date 18/11/15
 */

namespace site\frontend\modules\som\modules\qa\controllers;

use site\frontend\modules\som\modules\qa\components\QaController;
use site\frontend\modules\som\modules\qa\models\QaUserRating;

class RatingController extends QaController
{
    public function actionIndex($period)
    {
        $model = clone QaUserRating::model();
        $model->type($period)->orderPosition();
        $dp = new \CActiveDataProvider($model, array(
            'pagination' => array(
                'pageVar' => 'page',
                'pageSize' => 12,
            ),
        ));

        $this->render('index', compact('dp'));
    }
}