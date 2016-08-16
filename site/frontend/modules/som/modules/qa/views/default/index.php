<?php
/**
 * @var site\frontend\modules\som\modules\qa\controllers\DefaultController $this
 * @var \CActiveDataProvider $dp
 * @var string $tab
 * @var string $categoryId
 * @var site\frontend\modules\som\modules\qa\models\QaCategory $category
 */
$this->sidebar = array('ask', 'personal', 'menu' => array('categoryId' => $categoryId), 'rating');

$this->pageTitle = 'Ответы';

if ($categoryId !== null)
{
    $this->breadcrumbs = array(
        'Ответы' => array('/som/qa/default/index'),
        $category->title,
    );
}
else
{
    $this->breadcrumbs[] = 'Ответы';
}
?>

<?php $this->renderPartial('/_search', array('query' => '')); ?>
<?php
$this->widget('site\frontend\modules\som\modules\qa\widgets\QuestionsFilterWidget', array(
    'tab' => $tab,
    'categoryId' => $categoryId,
    'htmlOptions' => ['class' => 'filter-menu filter-menu_mod visibles-lg'],
));
?>
<div class="clearfix"></div>

<?php
$this->widget('LiteListView', array(
    'dataProvider' => $dp,
    'itemView' => '/_question',
    'htmlOptions' => array(
        'class' => 'questions margin-t40'
    ),
    'itemsTagName' => 'ul',
    'template' => '{items}<div class="yiipagination yiipagination__center">{pager}</div>',
    'pager' => [
        'class'           => 'LitePagerDots',
        'prevPageLabel'   => '&nbsp;',
        'nextPageLabel'   => '&nbsp;',
        'showPrevNext'    => TRUE,
        'showButtonCount' => 5,
        'dotsLabel'       => '<li class="page-points">...</li>'
    ]
));
?>