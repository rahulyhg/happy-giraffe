<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Main Category', 'url'=>array('root')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Categories</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('ext.QTreeGridView.CQTreeGridView', array(
	'id'=>'category-grid',
	'ajaxUpdate' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'category_id',
//		'category_root',
//		'category_level',
//		'category_lft',
//		'category_rgt',
		array(
			'name'=>'category_name',
			'value'=>'$data->nameExt',
		),
		'category_title',
		'category_keywords',
		/*
		'category_text',
		'category_description',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {up} {down} {sub} {update} {delete}',
			'buttons' => array(
				'up' => array(
					'label' => 'Up',
					'imageUrl' => '/shop/images/up.png',
					'url' => 'array("up","id"=>$data->category_id)',
				),
				'down' => array(
					'label' => 'Down',
					'imageUrl' => '/shop/images/down.png',
					'url' => 'array("down","id"=>$data->category_id)',
				),
				'sub' => array(
					'label' => 'Create subcategory',
					'imageUrl' => '/shop/images/plus.png',
					'url' => 'array("create","id"=>$data->category_id)',
				),
			),
		),
	),
)); ?>
