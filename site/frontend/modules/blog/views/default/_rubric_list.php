<?php
/**
 * @var int $currentRubricId
 */

$rubric_list = $this->user->blog_rubrics;
if ($this->user->id != Yii::app()->user->id) {
    $rubric_ids = CommunityRubric::notEmptyUserRubricIds($this->user->id);
    foreach ($rubric_list as $key => $rubric)
        if (!in_array($rubric->id, $rubric_ids))
            unset($rubric_list[$key]);
}
?>
<div class="menu-simple blogInfo" id="rubricsList">
    <?php $this->widget('zii.widgets.CMenu', array(
        'items' => array_map(function ($rubric) use($currentRubricId) {
            return array(
                'label' => $rubric->title,
                'url' => $rubric->getUrl(),
                'linkOptions' => array('class' => 'menu-simple_a'),
                'active' => $rubric->id == $currentRubricId,
            );
        }, $rubric_list),
        'itemCssClass' => 'menu-simple_li',
        'htmlOptions' => array('class' => 'menu-simple_ul')
    ));
    ?>
</div>