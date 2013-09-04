<?php
/**
 * @var CommunityContent $model
 * @var HActiveRecord $slaveModel
 * @var $json
 */

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'blog-form',
    'action' => $model->isNewRecord ? array('save') : array('save', 'id' => $model->id),
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'afterValidate' => new CJavaScriptExpression('js:function(form, data, hasError) {
            formVM.hasError(hasError);
            return ! hasError;
        }'),
    ),
)); ?>

<?=$form->hiddenField($model, 'type_id')?>

<div id="popup-user-add-article" class="b-settings-blue b-settings-blue__article">
    <div class="b-settings-blue_tale"></div>
    <div class="b-settings-blue_head">
        <div class="b-settings-blue_row clearfix">
            <div class="clearfix">
                <div class="float-r font-small color-gray margin-3" data-bind="length: { attribute : title, maxLength : 50 }"></div>
            </div>
            <?=$form->label($model, 'title', array('class' => 'b-settings-blue_label'))?>
            <div class="w-400 float-l">
                <?=$form->textField($model, 'title', array('class' => 'itx-simple w-400', 'placeholder' => 'Придумайте заголовок', 'data-bind' => 'value: title, valueUpdate: \'keyup\''))?>
                <?=$form->error($model, 'title')?>
            </div>
        </div>
        <div class="b-settings-blue_row clearfix">
            <?=$form->label($model, 'rubric_id', array('class' => 'b-settings-blue_label'))?>
            <div class="w-400 float-l">
                <div class="chzn-itx-simple js-select-rubric">
                    <select name="<?=CHtml::activeName($model, 'rubric_id')?>" id="<?=CHtml::activeId($model, 'rubric_id')?>" data-bind="options: rubricsList,
                    value: selectedRubric,
                    optionsText: function(rubric) {
                        return rubric.title;
                    },
                    optionsValue: function(rubric) {
                        return rubric.id;
                    },
                    chosenRubric: {}" data-placeholder="Выберите рубрику или создайте новую"></select>
                    <?=$form->error($model, 'rubric_id')?>
                </div>
                <div class="b-settings-blue_row-desc">Если вы не выберете рубрику, запись добавится в рубрику "Обо всем"</div>
            </div>
        </div>
    </div>

    <div class="wysiwyg-v wysiwyg-blue clearfix">
        <?php $slaveModel->text = $slaveModel->forEdit->text ?>
        <?=$form->textArea($slaveModel, 'text', array('class' => 'wysiwyg-redactor-v'))?>
        <div style="display: none;"><?=$form->error($slaveModel, 'text')?></div>
    </div>

    <div class="clearfix textalign-r">
        <?=$form->errorSummary(array($model, $slaveModel)) ?>
    </div>

    <div class=" clearfix">
        <button class="btn-blue btn-h46 float-r" data-bind="css: { 'btn-inactive' : hasError }"><?=$model->isNewRecord ? 'Добавить' : 'Редактировать'?></button>
        <a href="javascript:void(0)" onclick="$.fancybox.close()" class="btn-gray-light btn-h46 float-r margin-r15">Отменить</a>

        <div class="float-l margin-165">
            <div class="privacy-select clearfix">
                <?=$form->hiddenField($model, 'privacy', array('data-bind' => 'value: selectedPrivacyOption().value()'))?>
                <div class="privacy-select_hold clearfix">
                    <div class="privacy-select_tx">Для кого:</div>
                    <div class="privacy-select_drop-hold">
                        <a class="privacy-select_a" data-bind="click: $root.toggleDropdown, with: selectedPrivacyOption()">
                            <span class="ico-users active" data-bind="css: 'ico-users__' + cssClass()"></span>
                            <span class="privacy-select_a-tx" data-bind="html: title"></span>
                        </a>
                    </div>
                    <div class="privacy-select_drop" data-bind="css: { 'display-b' : showDropdown}">
                        <!-- ko foreach: privacyOptions -->
                        <div class="privacy-select_i">
                            <a class="privacy-select_a" data-bind="click: select">
                                <span class="ico-users" data-bind="css: 'ico-users__' + cssClass()"></span>
                                <span class="privacy-select_a-tx" data-bind="html: title"></span>
                            </a>
                        </div>
                        <!-- /ko -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('.wysiwyg-redactor-v').redactorHG({
        plugins: ['toolbarVerticalFixed'],
        minHeight: 410,
        autoresize: true,
        buttons: ['bold', 'italic', 'underline', 'deleted', 'h2', 'h3', 'unorderedlist', 'orderedlist', 'link_add', 'link_del', 'image', 'video', 'smile']
    });

    var BlogFormPostViewModel = function(data) {
        var self = this;
        ko.utils.extend(self, new BlogFormViewModel(data));
    }

    formVM = new BlogFormPostViewModel(<?=CJSON::encode($json)?>);
    ko.applyBindings(formVM, document.getElementById('popup-user-add-article'));
</script>