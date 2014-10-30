<?php
$this->breadcrumbs += array(
    'Блог'
);
$this->widget('site.frontend.modules.profile.widgets.UserSectionWidget');
?>
<div class="b-main_cont">
    <div class="b-main_col-hold clearfix">
        <?php
        $this->widget('LiteListView', array(
            'dataProvider' => $this->listDataProvider,
            'itemView' => '_view',
            'tagName' => 'div',
            'htmlOptions' => array(
                'class' => 'b-main_col-article'
            ),
            'itemsTagName' => 'div',
            'template' => '{items}<div class="yiipagination yiipagination__center">{pager}</div>',
            'pager' => array(
                'class' => 'LitePager',
                'prevPageLabel' => '&nbsp;',
                'nextPageLabel' => '&nbsp;',
                'showPrevNext' => true,
            ),
        ));
        ?>
        <aside class="b-main_col-sidebar visible-md"></aside>
    </div>
</div>