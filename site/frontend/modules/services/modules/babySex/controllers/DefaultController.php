<?php

class DefaultController extends HController
{
    public $layout = '//layouts/new';

    public function filters()
    {
        return array(
            'ajaxOnly + bloodUpdate, japanCalc, ovulationCalc',
        );
    }

    /**
     * @sitemap
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * @sitemap
     */
    public function actionBloodRefresh()
    {
        $this->render('blood_refresh');
    }

    /**
     * @sitemap
     */
    public function actionJapan()
    {
        $this->render('japan');
    }

    /**
     * @sitemap
     */
    public function actionBlood()
    {
        $this->render('blood_group');
    }

    /**
     * @sitemap
     */
    public function actionChina()
    {
        $service = Service::model()->findByPk(20);
        if (Yii::app()->request->isAjaxRequest) {
            $model = new ChinaCalendarForm;
            $model->attributes = $_POST['ChinaCalendarForm'];
            $this->performAjaxValidation($model, 'china-calendar-form');
        } else
            $this->render('china', compact('service'));
    }

    /**
     * @sitemap
     */
    public function actionOvulation()
    {
        $this->render('ovulation');
    }

    public function actionBloodUpdate()
    {
        if (isset($_POST['BloodRefreshForm'])) {
            $model = new BloodRefreshForm();
            $model->attributes = $_POST['BloodRefreshForm'];
            $this->performAjaxValidation($model, 'blood-refresh-form');

            $data = $model->CalculateMonthData();
            $gender = $model->GetGender();
            $this->renderPartial('_blood_refresh_result', array(
                'data' => $data,
                'year' => $model->review_year,
                'month' => $model->review_month,
                'model' => $model,
                'gender' => $gender
            ));
        }
    }

    public function actionJapanCalc()
    {
        if (isset($_POST['JapanCalendarForm'])) {
            $model = new JapanCalendarForm();
            $model->attributes = $_POST['JapanCalendarForm'];
            $this->performAjaxValidation($model, 'japan-form');

            $data = $model->CalculateData();
            $gender = $model->GetGender();
            $this->renderPartial('_japan_result', array(
                'data' => $data,
                'year' => $model->review_year,
                'month' => $model->review_month,
                'model' => $model,
                'gender' => $gender
            ));
        }
    }

    public function actionOvulationCalc()
    {
        if (isset($_POST['OvulationForm'])) {
            $modelForm = new OvulationForm();
            $modelForm->attributes = $_POST['OvulationForm'];
            $this->performAjaxValidation($modelForm, 'ovulation-form');
            $modelForm->validate();

            $data = $modelForm->CalculateData();
            $gender = $modelForm->GetGender();
            $this->renderPartial('ovulation_result', array(
                'data' => $data,
                'model' => $modelForm,
                'gender' => $gender,
                'year' => $modelForm->review_year,
                'month' => $modelForm->review_month,
            ));
        }
    }

    public function roundOpacity($op)
    {
        return round($op / 20) * 20;
    }

    public function performAjaxValidation($model, $formName)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] == $formName) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}