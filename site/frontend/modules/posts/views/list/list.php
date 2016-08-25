<?php
/**
 * @var \site\frontend\modules\posts\controllers\ListController $this
 */
$this->pageTitle = 'Блог - ' . $this->user->fullName;
$this->metaNoindex = true;
$this->breadcrumbs = array(
    'Блог',
);
$this->adaptiveBreadcrumbs = true;
?>

<?php $this->widget('site\frontend\modules\userProfile\widgets\UserSectionWidget', array('user' => $this->owner)); ?>

<div class="b-main blog-homepage">
    <?php if ($this->listDataProvider->totalItemCount == 0 && $this->getUser()->id == Yii::app()->user->id): ?>
        <div class="section-empty section-empty__blog">
            <div class="section-empty_t">Что бы вы хотели добавить в свой блог</div>
            <ul class="section-empty_ul">
                <li class="section-empty_li"><a href="<?php echo $this->createUrl('/blogs/add-form'); ?>" data-theme="transparent" class="section-empty_i fancy">
                        <div class="section-empty_ico section-empty_ico__blog"></div>
                        <div class="section-empty_ico-tx">Запись</div></a></li>
            </ul>
            <div class="section-empty_desc-hold">
                <div class="section-empty_desc">
                    <div class="section-empty_desc-tx">Добавляйте записи в свой блог и получайте баллы в свою личную копилку успехов! Скрасте записи фотографиями, видео, ссылками и делитесь ими с друзьями.</div>
                </div>
            </div>
        </div>
    <?php else: ?>
    	<div class="b-main_cont b-main_cont-xs">
    	<div class="b-main_col-hold clearfix">
    		<div class="b-main_col-articlex">
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
                ));
                ?>
        	</div>
        	<?php if (isset($this->owner->id) && $this->owner->id == \Yii::app()->user->id): ?>
        	<aside class="b-main_col-sidebar visible-md">
                <ul class="sidebar-widget">
                	<li class="sidebar-widget_item center-align">
                        <a id="addBlogBtn" class="btn bnt-massive green fancy is-need-loading disabled" href="<?=$this->createUrl('blogs/default/AddForm')?>" >Добавить в блог</a>
                    </li>
                </ul>
            </aside>
            <?php endif; ?>
    	</div>
    	</div>
        <div class="b-main_col-hold clearfix">
            <aside class="b-main_col-sidebar visible-md"></aside>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
$.afterCommonJSInit = function(){
	$('#addBlogBtn').removeClass('disabled');
};
</script>