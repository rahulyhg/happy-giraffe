<?php
/**
 * @author Никита
 * @date 09/11/15
 */

namespace site\frontend\modules\som\modules\qa\controllers;


use site\frontend\modules\som\modules\qa\models\QaConsultation;
use site\frontend\modules\som\modules\qa\models\QaQuestion;

class DefaultController extends \LiteController
{
    public $litePackage = 'posts';

    public function actionView($id)
    {
        $question = $this->getModel($id);
        $this->render('view', compact('question'));
    }

    public function actionQuestionAddForm($consultationId = null)
    {
        $question = new QaQuestion();
        $this->performAjaxValidation($question);
        if ($consultationId !== null) {
            $consultation = QaConsultation::model()->with('category')->findByPk($consultationId);
            if ($consultation === null) {
                throw new \CHttpException(404);
            }
            $question->categoryId = $consultation->category->id;
            $question->scenario = 'consultation';
        }

        if (isset($_POST[\CHtml::modelName($question)])) {
            $question->attributes = $_POST[\CHtml::modelName($question)];
            if ($question->save()) {
                $this->redirect($question->url);
            }
        }

        $this->render('addForm', array('model' => $question));
    }

    public function actionQuestionEditForm($questionId)
    {
        $question = $this->getModel($questionId);
        $this->performAjaxValidation($question);
        if ($question->category->consultationId !== null) {
            $question->scenario = 'consultation';
        }

        if (isset($_POST[\CHtml::modelName($question)])) {

        }
    }

    protected function getModel($pk)
    {
        $question = QaQuestion::model()->with('category')->findByPk($pk);
        if ($question === null) {
            throw new \CHttpException(404);
        }
        return $question;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'question-form')
        {
            echo \CActiveForm::validate($model);
            \Yii::app()->end();
        }
    }
}