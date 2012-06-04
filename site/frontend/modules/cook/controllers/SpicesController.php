<?php

class SpicesController extends HController
{
    public function actionIndex()
    {
        $this->pageTitle = 'Приправы и специи';
        $obj = CookSpice::model()->getSpicesByAlphabet();

        $this->render('index', compact('obj'));
    }

    public function actionCategory($id)
    {
        $model = CookSpiceCategory::model()->with('spices', 'photo')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');

        $this->pageTitle = 'Приправы и специи '.$model->title;

        $this->render('category', compact('model'));
    }

    public function actionView($id)
    {
        $model = CookSpice::model()->with('photo', 'categories', 'hints')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');

        $this->pageTitle = 'Приправы и специи '.$model->title;

        $this->render('view', compact('model'));
    }
}