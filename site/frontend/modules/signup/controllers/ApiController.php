<?php

namespace site\frontend\modules\signup\controllers;
use site\frontend\modules\signup\models\RegisterForm;

/**
 * @author Никита
 * @date 12/12/14
 */

class ApiController extends \site\frontend\components\api\ApiController
{
    public function actionRegister(array $attributes)
    {
        $form = new RegisterForm();
        $form->attributes = $attributes;
        $this->success = $form->save();
        $this->data = array(
            'errors' => $form->getErrors(),
        );
    }
} 