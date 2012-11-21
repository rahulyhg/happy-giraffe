<div class="reg2" style="display: none;">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'reg-form2',
    'action' => '#',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'inputContainer' => '.row',
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => false,
        'validationUrl' => Yii::app()->createUrl('/signup/validate', array('step' => 2)),
        'afterValidate' => "js:function(form, data, hasError) {
                            if (!hasError){
                                Register.finish();
                            }
                            return false;
                          }",
    )));?>

    <div class="register-form">

        <div class="block-title"><?=$this->template[$type]['step2']['title1'] ?></div>

        <div class="hl">
            <span><?=$this->template[$type]['step2']['title2'] ?></span>
        </div>

        <div class="clearfix">

            <div class="ava-box">

                <div class="ava"<?php if (!isset($regdata['avatar'])) echo ' style="display:none;"' ?>>
                    <?php if (isset($regdata['photo'])) echo CHtml::image($regdata['photo'], 'Это Вы') ?>
                </div>

            </div>
            <?=CHtml::hiddenField('form_type', $type) ?>
            <?php if (isset($regdata['avatar'])) echo $form->hiddenField($model, 'avatar', array('value' => $regdata['avatar'])); ?>

            <div class="form-in">

                <div class="row clearfix">
                    <div class="row-title">
                        <label>Имя:</label>
                    </div>
                    <div class="row-elements">
                        <?=$form->textField($model, 'first_name'); ?>
                    </div>
                    <div class="row-error">
                        <i class="error-ok"></i>
                        <?=$form->error($model, 'first_name'); ?>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="row-title">
                        <label>Фамилия:</label>
                    </div>
                    <div class="row-elements">
                        <?=$form->textField($model, 'last_name'); ?>
                    </div>
                    <div class="row-error">
                        <i class="error-ok"></i>
                        <?=$form->error($model, 'last_name'); ?>
                    </div>
                </div>

                <div class="row clearfix email2-row" style="display: none;">
                    <div class="row-title">
                        <label>E-mail:</label>
                    </div>
                    <div class="row-elements">
                        <?=$form->textField($model, 'email', array('class' => 'regmail2', 'placeholder' => 'Введите ваш e-mail')); ?>
                    </div>
                    <div class="row-error">
                        <i class="error-ok"></i>
                        <?=$form->error($model, 'email'); ?>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="row-title">
                        <label>Пароль:</label>
                    </div>
                    <div class="row-elements">
                        <?=$form->passwordField($model, 'password', array('autocomplete'=>'off')); ?>
                    </div>
                    <div class="row-error">
                        <i class="error-ok"></i>
                        <?=$form->error($model, 'password'); ?>
                    </div>
                </div>

                <?php
                if ($this->template[$type]['inputBirthday'])
                    $this->render('step2_birthday',compact('model', 'form', 'regdata'));
                elseif ($this->type == 'pregnancy')
                    $this->render('step2_pregnancy',compact('model', 'form', 'regdata'));
                else
                    $this->render('step2_default',compact('model', 'form', 'regdata'));
                ?>

                <div class="row clearfix row-center">
                    <input type="submit" value="Регистрация">
                </div>

            </div>

        </div>

    </div>

    <?php $this->endWidget(); ?>
</div>
