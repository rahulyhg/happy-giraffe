<?php

class TestQuestionAnswerController extends HController
{
    public $defaultAction = 'admin';
    public $section = 'club';
    public $layout = '//layouts/club';
    public $_class = 'TestQuestionAnswer';
    public $authItem = 'cook_ingredients';

    public function actions()
    {
        return array(
            'create' => 'application.components.actions.Create',
            'update' => 'application.components.actions.Update',
            'delete' => 'application.components.actions.Delete',
            'admin' => 'application.components.actions.Admin'
        );
    }
}