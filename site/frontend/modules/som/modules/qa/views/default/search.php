<?php
/**
 * @var site\common\components\SphinxDataProvider $dp
 * @var string $query
 */
$this->sidebar = array('ask', 'personal', 'menu');
?>

<?php $this->renderPartial('/_search', compact('query')); ?>
<div class="only-mobile"><a href="#AskWidget" class="consult-specialist_btn btn btn-success btn-xl popup-a">Задать вопрос</a></div>
<?php if (empty($query) || $dp->totalItemCount == 0): ?>
    <p>Ничего не найдено</p>
<?php else: ?>
<div class="search-heading">
    <div class="hash-tag-big"></div>
    <div class="heading-link-xxl"> <?=$query?>&nbsp;<span><?=$dp->totalItemCount?></span></div>
    <div class="clearfix"></div>
</div>
<?php
$this->widget('LiteListView', array(
    'dataProvider' => $dp,
    'itemView' => '/_question',
    'htmlOptions' => array(
        'class' => 'questions'
    ),
    'itemsTagName' => 'ul',
    'template' => '{items}<div class="yiipagination yiipagination__center">{pager}</div>',
    'pager' => array(
        'class' => 'LitePager',
        'maxButtonCount' => 10,
        'prevPageLabel' => '&nbsp;',
        'nextPageLabel' => '&nbsp;',
        'showPrevNext' => true,
    ),
));
?>
<?php endif; ?>

