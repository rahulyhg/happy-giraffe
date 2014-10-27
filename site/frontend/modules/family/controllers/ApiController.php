<?php
/**
 * @author Никита
 * @date 23/10/14
 */

namespace site\frontend\modules\family\controllers;


use site\frontend\modules\family\models\Family;

class ApiController extends \site\frontend\components\api\ApiController
{
    public function actions()
    {
        return \CMap::mergeArray(parent::actions(), array(
            'update' => array(
                'class' => 'site\frontend\components\api\EditAction',
                'modelName' => '\site\frontend\modules\family\models\FamilyMember',
            ),
        ));
    }

    public function actionGet()
    {
        $family = Family::getByUserId(\Yii::app()->user->id);
        $this->success = $family !== null;
        if ($family !== null) {
            $this->data = $family;
        }
    }
} 