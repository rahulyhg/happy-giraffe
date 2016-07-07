<?php
/**
 * @var site\frontend\modules\som\modules\qa\controllers\DefaultController $this
 * @var \CActiveDataProvider $dp
 * @var string $tab
 * @var string $categoryId
 * @var site\frontend\modules\som\modules\qa\models\QaCategory $category
 */
$this->sidebar = array('ask', 'personal', 'menu' => array('categoryId' => $categoryId), 'rating');


if ($categoryId !== null) {
    $this->pageTitle = '';
    
    $this->breadcrumbs = array(
        'Ответы' => array('/som/qa/default/index'),
        $category->title,
    );
}
else {
    $this->pageTitle = 'Вопрос-ответ';
}
?>


<?php $this->renderPartial('/_search', array('query' => '')); ?>
<?php
$this->widget('site\frontend\modules\som\modules\qa\widgets\QuestionsFilterWidget', array(
    'tab' => $tab,
    'categoryId' => $categoryId,
));
?>
<div class="clearfix"></div>

<?php
$this->widget('LiteListView', array(
    'dataProvider' => $dp,
    'itemView' => '/_question',
    'htmlOptions' => array(
        'class' => 'questions'
    ),
    'itemsTagName' => 'ul',
    'template' => '{items}<div class="yiipagination yiipagination__center">{pager}</div>',
));
?>