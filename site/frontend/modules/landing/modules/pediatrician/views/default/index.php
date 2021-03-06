<?php
/**
 * @var CController $this
 */
?>

<div class="landing">
    <?php $this->renderPartial('/_header'); ?>
    <?php $this->renderPartial('/_editor', ['model' => $dp->model, 'category' => $category]); ?>
    <?php $this->widget(\site\frontend\modules\landing\modules\pediatrician\widgets\doctors\DoctorsWidget::class); ?>
    <div class="landing__body">
        <div class="landing-question">
            <div class="textalign-c margin-b30">
            	<div class="font__title-xm font__bold">Последние вопросы</div>
            </div>
                <?php
                $this->widget(LiteListView::class, array(
                    'dataProvider' => $dp,
                    'itemView' => '/_question',
                    'itemsTagName' => 'ul',
                    'itemsCssClass' => 'questions questions-modification',
                    'template' => '{items}<div class="yiipagination yiipagination__center"></div>',
                ));
                ?>
                <div class="textalign-c">
                    <a href="#" class="btn btn-forum btn-success">Задать вопрос</a>
                </div>
        </div>
    </div>
    <?php $this->renderPartial('/_footer'); ?>
</div>