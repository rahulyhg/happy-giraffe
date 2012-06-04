<h1>Ингредиенты</h1>

<?php echo CHtml::link('создать', array('club/CookIngredient/create')) ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cook-ingredients-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'value' => '$data->category->title',
            'header' => 'Категория'
        ),
        array(
            'value' => '$data->unit->title',
            'header' => 'Ед.изм.'
        ),
        array(
            'name' => 'title',
            'value' => 'CHtml::link ( CHtml::encode ( $data->title ),  array ( "club/cookIngredients/update", "id" => $data->id ) )',
            'type'=>'raw'
        ),
        'weight',
        'density',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}'
        ),
    ),
)); ?>
