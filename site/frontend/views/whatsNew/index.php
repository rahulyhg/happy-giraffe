<?php
    Yii::app()->clientScript
        ->registerCssFile('/stylesheets/user.css')
    ;

    Yii::app()->eauth->renderWidget(array(
        'mode' => 'assets',
    ));
?>

<div id="broadcast" class="broadcast-all">

    <?php $this->renderPartial('menu'); ?>

    <div class="content-cols clearfix">

        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dp,
                'itemView' => '_brick',
                'template' => "{items}\n{pager}",
                'itemsTagName' => 'ul',
                'htmlOptions' => array(
                    'class' => 'masonry-news-list',
                ),
            ));
        ?>

    </div>

</div>