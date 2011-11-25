<?php
$this->breadcrumbs=array(
	'Product Attribute Value Maps',
);

$this->menu=array(
	array('label'=>'Create ProductAttributeValueMap', 'url'=>array('create')),
	array('label'=>'Manage ProductAttributeValueMap', 'url'=>array('admin')),
);
?>

<h1>Product Attribute Value Maps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
