<?php
namespace site\frontend\modules\consultation\controllers;
use site\frontend\modules\consultation\models\Consultation;
use site\frontend\modules\consultation\models\ConsultationAnswer;
use site\frontend\modules\consultation\models\ConsultationQuestion;
use site\frontend\modules\consultation\models\forms\AskForm;

/**
 * @author Никита
 * @date 20/03/15
 */

class DefaultController extends \LiteController
{
    public $layout = 'main';

    public $consultation;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'users' => array('?'),
                'actions' => array('create'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $cs = \Yii::app()->clientScript;
            $package = \Yii::app()->user->isGuest ? 'lite_consultation' : 'lite_consultation_user';
            $cs->registerPackage($package);
            $cs->useAMD = true;
            return true;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex($slug)
    {
        $this->consultation = $this->loadModel($slug);
        $dp = new \CActiveDataProvider('\site\frontend\modules\consultation\models\ConsultationQuestion', array(
            'criteria' => array(
                'scopes' => array(
                    'listView',
                    'orderDesc',
                    'consultation' => $this->consultation->id,
                ),
            ),
            'pagination' => array(
                'pageVar' => 'page',
            ),
        ));
        $this->render('index', compact('dp'));
    }

    /**
     * @sitemap dataSource=sitemapView
     */
    public function actionQuestion($questionId)
    {
        $question = ConsultationQuestion::model()->with('consultation')->findByPk($questionId);
        if ($question === null) {
            throw new \CHttpException(404);
        }
        $this->consultation = $question->consultation;
        $this->render('question', compact('question'));
    }

    public function actionCreate($slug, $questionId = null)
    {
        if ($questionId === null) {
            throw new \CHttpException(404);
        }

        $consultation = $this->loadModel($slug);
        if ($questionId === null) {
            $model = new ConsultationQuestion();
        } else {
            $model = ConsultationQuestion::model()->findByPk($questionId);
            if ($model === null) {
                throw new \CHttpException(404);
            }
        }

        if (isset($_POST[\CHtml::modelName($model)])) {
            if (isset($_POST['ajax'])) {
                echo \CActiveForm::validate($model);
                \Yii::app()->end();
            }

            $model->attributes = $_POST[\CHtml::modelName($model)];
            $model->consultationId = $consultation->id;

            if ($model->save()) {
                $this->redirect($model->consultation->getUrl());
            }
        }

        $this->layout = '//layouts/lite/form';
        $this->render('create', compact('model'));
    }

    public function actionAnswer($questionId)
    {
        $question = ConsultationQuestion::model()->findByPk($questionId);
        if ($question === null) {
            throw new \CHttpException(404);
        }
        $consultant = $question->consultation->getConsultantByUserId(\Yii::app()->user->id);
        if ($consultant === null) {
            throw new \CHttpException(403);
        }

        $model = ($question->answer === null) ? new ConsultationAnswer() : $question->answer;

        if (isset($_POST[\CHtml::modelName($model)])) {
            if (isset($_POST['ajax'])) {
                echo \CActiveForm::validate($model);
                \Yii::app()->end();
            }

            $model->attributes = $_POST[\CHtml::modelName($model)];
            $model->questionId = $questionId;
            $model->consultantId = $consultant->id;

            if ($model->save()) {
                $this->redirect($question->consultation->getUrl());
            }
        }

        $this->layout = 'form';
        $this->render('answer', compact('model'));
    }

    public function isConsultant()
    {
        return \Yii::app()->user->checkAccess('answerQuestions', array('consultation' => $this->consultation));
    }

    protected function loadModel($slug)
    {
        $consultation = Consultation::model()->slug($slug)->find();
        if ($consultation === null) {
            throw new \CHttpException(404);
        }
        return $consultation;
    }

    public function sitemapView()
    {
        $criteria = ConsultationQuestion::model()->getDbCriteria();
        $criteria->order = 'id ASC';
        $command = \Yii::app()->db->getCommandBuilder()->createFindCommand(ConsultationQuestion::model()->tableName(), $criteria);
        $models = $command->queryAll();
        return array_map(function($model) {
            return array(
                'loc' => $model['url'],
                'lastmod' => date(DATE_W3C, $model['updated']),
            );
        }, $models);
    }
}