<?php
/**
 * @author Никита
 * @date 31/10/14
 */

namespace site\frontend\modules\photo\controllers;


use site\frontend\modules\photo\models\Photo;
use site\frontend\modules\photo\models\PhotoAttach;

class TestController extends \HController
{
    public function actionCrop()
    {
        $attach = PhotoAttach::model()->findByPk(181);
        echo $attach->getUrl();
    }
} 