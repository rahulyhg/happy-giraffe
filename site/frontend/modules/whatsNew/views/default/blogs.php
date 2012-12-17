<?php
    $channel = ($show == EventManager::WHATS_NEW_BLOGS) ? 'whatsNewBlogs' : 'whatsNewBlogsUser' . Yii::app()->user->id;

    Yii::app()->clientScript
        ->registerCssFile('/stylesheets/user.css')
        ->registerCssFile('/stylesheets/isotope.css')
        ->registerScriptFile('/javascripts/jquery.isotope.min.js')
        ->registerScriptFile('/javascripts/live.js')
        ->registerScript('Realplexor-reg-whatsNew', 'comet.connect(\'http://' . Yii::app()->comet->host . '\', \'' . Yii::app()->comet->namespace . '\', \'' . $channel . '\');')
    ;

    Yii::app()->eauth->renderWidget(array(
        'mode' => 'assets',
    ));
?>

<div id="broadcast">

    <?php $this->renderPartial('/menu'); ?>

    <div class="content-cols clearfix">

        <div class="col-12">
            <?php
                $this->widget('zii.widgets.CListView', array(
                    'id' => 'liveList',
                    'dataProvider' => $dp,
                    'itemView' => '_brick',
                    'template' => "{items}\n{pager}",
                    'itemsTagName' => 'ul',
                    'htmlOptions' => array(
                        'class' => 'masonry-news-list',
                    ),
                    'pager' => array(
                        'header' => '',
                        'class' => 'ext.infiniteScroll.IasPager',
                        'rowSelector' => 'li',
                        'listViewId' => 'liveList',
                        'options' => array(
                            'scrollContainer' => new CJavaScriptExpression("$('.layout-container')"),
                            'tresholdMargin' => -250,
                            'onRenderComplete' => new CJavaScriptExpression("function(items) {
                                var newItems = $(items);

                                newItems.hide().imagesLoaded(function() {
                                    newItems.show();
                                    $('#liveList .items').isotope('appended', newItems);
                                });
                            }"),
                        ),
                    ),
                ));
            ?>
        </div>

        <div class="col-3 clearfix">
            <?php if ($this->beginCache('bestUsers-blogs', array('duration' => 600))): ?>
                <?php $this->widget('ActiveUsersWidget', array(
                    'type' => ActiveUsersWidget::TYPE_BLOGS,
                )); ?>
            <?php $this->endCache(); endif; ?>
        </div>

    </div>

</div>

