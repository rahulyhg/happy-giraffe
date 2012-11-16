<?php
/* @var $model HoroscopeCompatibility
 * @var $form CActiveForm
 */

$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
$baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);
Yii::app()->clientScript
    ->registerScriptFile($baseUrl . '/script.js', CClientScript::POS_HEAD)
    ->registerScriptFile('/javascripts/addtocopy.js');

?><div class="horoscope-compatibility clearfix">

    <?php if (isset($showTitle)):?>
        <div class="block-title">Совместимость знаков</div>
    <?php endif ?>

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'placenta-thickness-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'action' => '#',
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'validateOnType' => false,
        'validationUrl' => array('/horoscope/compatibility/validate/'),
        'afterValidate' => "js:function(form, data, hasError) {
                                if (!hasError)
                                    Horoscope.calc();
                                return false;
                              }",
    )));?>

    <div class="sign">
        <div class="img" onclick="Horoscope.showSelect(this)"><img src="<?=Horoscope::getZodiacPhoto($model->zodiac1) ?>"></div>
        <div class="chzn-v2-lilac"<?php if (empty($model->zodiac1)) echo ' style="display:none;"' ?>>
        <?=$form->dropDownList($model, 'zodiac1', Horoscope::model()->zodiac_list, array(
        'class'=>'chzn',
        'onchange'=>'Horoscope.ZodiacChange(this)',
        'empty'=>'&nbsp;',
    )) ?></div>
        <?=$form->error($model, 'zodiac1') ?>
    </div>
    <div class="plus"></div>
    <div class="sign">
        <div class="img" onclick="Horoscope.showSelect(this)"><img src="<?=Horoscope::getZodiacPhoto($model->zodiac2) ?>"></div>
        <div class="chzn-v2-lilac"<?php if (empty($model->zodiac2)) echo ' style="display:none;"' ?>>
        <?=$form->dropDownList($model, 'zodiac2', Horoscope::model()->zodiac_list, array(
        'class'=>'chzn',
        'onchange'=>'Horoscope.ZodiacChange(this)',
        'empty'=>'&nbsp;',
    )) ?></div>
        <?=$form->error($model, 'zodiac2') ?>
    </div>
    <div class="equal"></div>
    <div class="button">
        <a href="javascript:;" onclick="$(this).parents('form').submit();">Узнать!</a>
    </div>

    <?=$form->errorSummary($model); ?>
    <?php $this->endWidget(); ?>
</div>
