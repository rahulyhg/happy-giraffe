<?php
/**
 * @author Никита
 * @date 13/03/15
 */

namespace site\frontend\modules\analytics\controllers;

class ApiController extends \site\frontend\components\api\ApiController
{
    public function actionProcessHit($inc = true, $url = null)
    {
        if ($url === null) {
            $url = \Yii::app()->request->getUrlReferrer();
        }
        $this->success = true;
        $this->data = array(
            'url' => $url,
            'visits' => \Yii::app()->getModule('analytics')->visitsManager->getVisits($url),
        );
        if ($inc) {
            $this->data['counted'] = \Yii::app()->getModule('analytics')->visitsManager->processVisit($url);
        }
    }
}