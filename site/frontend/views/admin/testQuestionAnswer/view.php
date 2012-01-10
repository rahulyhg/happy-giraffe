<?php
$this->breadcrumbs=array(
	'Test Question Answers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TestQuestionAnswer', 'url'=>array('index')),
	array('label'=>'Create TestQuestionAnswer', 'url'=>array('create')),
	array('label'=>'Update TestQuestionAnswer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestQuestionAnswer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestQuestionAnswer', 'url'=>array('admin')),
);
?>

<h1>View TestQuestionAnswer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'test_question_id',
		'number',
		'points',
		'text',
	),
)); ?>
