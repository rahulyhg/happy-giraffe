<?php
$basePath = Yii::getPathOfAlias('cook') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'recipe' . DIRECTORY_SEPARATOR . 'assets';
$baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);

$cs = Yii::app()->clientScript;

$cs
    ->registerScriptFile($baseUrl . '/advancedSearch.js', CClientScript::POS_HEAD)
    ->registerScriptFile('/javascripts/jquery.jscrollpane.min.js')
    ->registerCssFile('/stylesheets/jquery.jscrollpane.css')
;

$this->breadcrumbs = array(
    'Кулинария' => array('/cook'),
    'Рецепты' => array('/cook/recipe/index', 'section' => $this->section),
    'Расширенный поиск'
);
?>

<div id="cook-recipe-search">
    <?=CHtml::beginForm(array('/cook/recipe/advancedSearchResult/', 'section' => $this->section), 'get', array('id' => 'searchRecipeForm'))?>

    <div class="title clear">
        <i class="icon"></i>
        <span>Поиск рецепта</span>

        <div class="nav">
            <ul>
                <li><?=HHtml::link('По ингредиентам', array('/cook/recipe/searchByIngredients', 'section' => $this->section), array(), true)?></li>
                <li class="active"><?=HHtml::link('Расширенный поиск', array('/cook/recipe/advancedSearch', 'section' => $this->section), array(), true)?></li>
            </ul>
        </div>
    </div>

    <div class="clearfix">

        <div class="advanced">

            <div class="block-title">Параметры рецепта</div>

            <?php if ($this->section != 1): ?>
                <div class="row">
                    <label>Кухня</label>
                    <span class="chzn-v2">
                        <?=CHtml::dropDownList('cuisine_id', null, CHtml::listData($cuisines, 'id', 'title'), array('prompt' => 'не выбрана', 'class' => 'chzn'))?>
                    </span>
                </div>
            <?php endif; ?>

            <div class="row">
                <label>Тип блюда</label>
                <span class="chzn-v2">
                    <?=CHtml::dropDownList('type', null, CActiveRecord::model($this->modelName)->types, array('prompt' => 'не выбран', 'class' => 'chzn'))?>
                </span>
            </div>

            <div class="block-title">Время</div>

            <div class="row">
                <label><i class="icon-time-1"></i>Подготовка</label>
                <span class="chzn-v2">
                    <?=CHtml::dropDownList('preparation_duration', null, CActiveRecord::model($this->modelName)->durationLabels, array('prompt' => 'не важно', 'class' => 'chzn'))?>
                </span>
            </div>

            <div class="row">
                <label><i class="icon-time-2"></i>Приготовление</label>
                <span class="chzn-v2">
                    <?=CHtml::dropDownList('cooking_duration', null, CActiveRecord::model($this->modelName)->durationLabels, array('prompt' => 'не важно', 'class' => 'chzn'))?>
                </span>
            </div>

            <div class="block-title">Диетические предпочтения</div>

            <div class="radiogroup">

                <span class="checkbox">
                    <?=CHtml::checkbox('forDiabetics1', false, array('uncheckValue' => false))?>
                    <label>Для диабетиков</label>
                </span>

                <span class="checkbox">
                    <?=CHtml::checkbox('lowCal', false, array('uncheckValue' => false))?>
                    <label>Низкокалорийные</label>
                </span>

                <span class="checkbox">
                    <?=CHtml::checkbox('forDiabetics2', false, array('uncheckValue' => false))?>
                    <label>Низкоуглеводные</label>
                </span>

                <span class="checkbox">
                    <?=CHtml::checkbox('lowFat', false, array('uncheckValue' => false))?>
                    <label>Низкожирные</label>
                </span>

            </div>

        </div>

        <div class="result">

            <div class="arrow"></div>

            <div class="text">

                <img src="/images/cook_recipe_search_fork.gif"/><br/>

                <span>Выберите параметры<br/>поиска</span>

            </div>

        </div>

    </div>

    <?=CHtml::endForm()?>
</div>