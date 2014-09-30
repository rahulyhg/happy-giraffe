<?php
/**
 * Created by PhpStorm.
 * User: mikita
 * Date: 23/09/14
 * Time: 16:40
 */

namespace site\frontend\modules\photo\controllers;


use site\frontend\components\api\ApiController;

class PhotosApiController extends ApiController
{
    public function actionMakeAvatar($photoId, array $cropData)
    {
        $photo = $this->getModel('site\frontend\modules\photo\models\Photo', $photoId);

        \Yii::app()

        $crop = new \PhotoCrop();
        $crop->attributes = $cropData;
        $crop->photo_id = $photoId;
        $crop->save();
    }
} 