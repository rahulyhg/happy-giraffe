<script type="text/javascript">
var set_id = <?php echo $model->set_id ?>;
$(function () {
    $('body').delegate('.add_attr', 'click', function () {
        if ($(this).hasClass('in_price'))
            var in_price = 1;
        else
            var in_price = 0;

        $.ajax({
            url:'<?php echo Yii::app()->createUrl("pack/CreateAttribute") ?>',
            data:{in_price:in_price},
            type:'POST',
            success:function (data) {
                $(this).hide();
                $(this).parent('li').append(data);
                var form = $(this).next('form');
                form.children('p').children('select').selectBox();
                form.children('p').children(".niceCheck").each(
                    function () {
                        changeCheckStart(jQuery(this));
                    });
            },
            context:$(this)
        });

        return false;
    });

    $('body').delegate('.attr-name a.edit', 'click', function () {
        var bl = $(this).parents('li.set_attr_li');
        var id = bl.attr('obj_id');

        $.ajax({
            url:'<?php echo Yii::app()->createUrl("pack/UpdateAttribute") ?>',
            data:{id:id},
            type:'POST',
            success:function (data) {
                var li = $(this).parents('li.set_attr_li');
                li.html(data);
                var form = li.find('form');
                form.children('p').children('select').selectBox();
                form.children('p').children(".niceCheck").each(
                    function () {
                        changeCheckStart(jQuery(this));
                    });
            },
            context:$(this)
        });

        return false;
    });

    $('body').delegate('#attribute-form input.add_attr_btn', 'click', function () {
        $.ajax({
            url:'<?php echo Yii::app()->createUrl("pack/CreateAttribute") ?>',
            data:$(this).parent().parent('form').serialize() + '&set_id=' + set_id,
            type:'POST',
            dataType:'JSON',
            success:function (data) {
                if (data !== null && data.hasOwnProperty('success'))
                    if (data.success) {
                        var obj_id = data.id;
                        $.ajax({
                            url:'<?php echo Yii::app()->createUrl("pack/AttributeView") ?>',
                            data:{id:data.id},
                            type:'POST',
                            success:function (data) {
                                $(this).parent().parent().parent().find('.add_attr').show();
                                $(this).parent().parent().parent().before(data);
                                var item = $(this).parent().parent().parent().prev();
                                $(this).parent().parent('form').find('select').selectBox('destroy');
                                $(this).parent().parent('form').remove();

                                refreshSorter();
                            },
                            context:$(this)
                        });
                    }
            },
            context:$(this)
        });

        return false;
    });

    $('body').delegate('#attribute-form input.edit_attr_btn', 'click', function () {
        $.ajax({
            url:'<?php echo Yii::app()->createUrl("pack/UpdateAttribute") ?>',
            data:$(this).parent().parent('form').serialize() + '&set_id=' + set_id,
            type:'POST',
            dataType:'JSON',
            success:function (data) {
                if (data !== null && data.hasOwnProperty('success'))
                    if (data.success) {
                        $.ajax({
                            url:'<?php echo Yii::app()->createUrl("pack/AttributeView") ?>',
                            data:{id:data.id},
                            type:'POST',
                            success:function (data) {
                                $(this).parent().parent('form').find('select').selectBox('destroy');
                                $(this).parent().parent().parent().before(data);
                                $(this).parent().parent().parent().remove();
                                refreshSorter();
                            },
                            context:$(this)
                        });
                    }
            },
            context:$(this)
        });

        return false;
    });

    $('body').delegate('.attr-name .delete', 'click', function () {
        ConfirmPopup('Вы точно хотите удалить атрибут "' + $(this).prev().prev().text() + '"', $(this), function (owner) {
            var bl = owner.parents('li.set_attr_li');
            var id = bl.attr('obj_id');
            var class_name = 'Attribute';

            $.ajax({
                url:'<?php echo Yii::app()->createUrl("ajax/delete") ?>',
                data:{
                    class:class_name,
                    id:id
                },
                type:'GET',
                success:function (data) {
                    if (data == '1') {
                        bl.remove();
                    }
                    refreshSorter();
                },
                context:owner
            });

        });
        return false;
    });

    $('body').delegate('a.triangle', 'click', function () {
        if ($(this).hasClass('vain'))
            var value = 1;
        else
            var value = 0;

        if ($(this).hasClass('sort-attr')) {
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("ajax/SetValue") ?>',
                data:{
                    id:set_id,
                    attribute:$(this).prev().val(),
                    class:'AttributeSet',
                    value:value
                },
                type:'GET',
                success:function (data) {
                    if (data == '1')
                        $(this).toggleClass('vain');
                },
                context:$(this)
            });
        } else {
            var attr_id = $(this).parent('li').attr('obj_id');
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("ajax/SetValue") ?>',
                data:{
                    id:attr_id,
                    attribute:'attribute_is_insearch',
                    class:'Attribute',
                    value:value
                },
                type:'GET',
                success:function (data) {
                    if (data == '1')
                        $(this).toggleClass('vain');
                },
                context:$(this)
            });
        }
        return false;
    });

    $('body').delegate('#Attribute_attribute_type', 'change', function () {
        if ($(this).val() == <?php echo Attribute::TYPE_MEASURE ?>) {
            $(this).parent().parent().find('p').show();
        } else {
            $(this).parent().next('p').hide();
            $(this).parent().next('p').next('p').hide();
        }

    });

    $('body').delegate('#attribute_measure', 'change', function () {
        if ($('#attribute_measure').val() != '')
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("pack/GetMeasureOptions"); ?>',
                data:{id:$('#attribute_measure').val()},
                type:'POST',
                success:function (data) {
                    $('#Attribute_measure_option_id').html(data);
                    $('#Attribute_measure_option_id').selectBox('refresh');
                },
                context:$(this)
            });
    });

    sortableInit();
});

function sortableInit() {
    $("#sortable").sortable({revert:true});

    $("#sortable").bind("sortstop", function (event, ui) {
        var id = ui.item.find('input[name=\"id\"]').val();
        var new_pos = ui.item.prev().find('input[name=\"id\"]').val();
//        if (ui.originalPosition.top == ui.position.top)
//            return false;

        $.ajax({
            dataType:'JSON',
            type:'GET',
            url:'<?php echo Yii::app()->createUrl('pack/AttributePosition') ?>',
            data:{
                id:id,
                new_pos:new_pos,
                set_id:set_id
            },
            success:function (response) {
                if (response.success) {

                }
            },
            context:$(this)
        });
    });
    $(".filter_sorter ul li.sort-elem").disableSelection();
}

function refreshSorter() {
    $.ajax({
        url:'<?php echo Yii::app()->createUrl("pack/GetSortBlock") ?>',
        data:{set_id:set_id},
        type:'GET',
        success:function (data) {
            $('#sortable').sortable("destroy");
            $('.filter_sorter').html(data);
            sortableInit();
            console.log('refresh');
        },
        context:$(this)
    });
}
</script>
<?php

Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->widget('SimpleFormInputWidget', array(
    'init' => true,
));
$this->widget('SimpleFormAddWidget', array(
    'init' => true,
));

/**
 * @var AttributeSet $model
 */
?>
<div class="centered">

    <h1>Пакет свойств - <?php echo $model->set_title ?></h1>

    <p class="text_header">Название</p>

    <div class="text_block">
        <p>Бренд</p>
    </div>

    <p class="text_header">Описание</p>

    <div class="text_block">

    </div>

    <p class="text_header">Цена</p>

    <div class="text_block">
        <ul class="inline_block">
            <?php foreach ($model->set_map as $attribute): ?>
            <?php $attr = Attribute::model()->findByPk($attribute->map_attribute_id); ?>
            <?php if ($attr->attribute_in_price) $this->renderPartial('_attribute_view', array('model' => $attr)); ?>
            <?php endforeach; ?>
            <li>
                <span class="add_paket add_attr in_price" title="Добавить характеристику">+</span>
            </li>
        </ul>
        <div class="clear"></div>
    </div>

    <div class="filter_sorter">
        <?php $this->renderPartial('_sorter', array('model' => $model)); ?>
    </div>

    <div class="propertyBlock">
        <p class="text_header">Характеристики</p>
        <?php $attributes = $model->set_map ?>

        <div class="text_block">
            <ul class="inline_block">
                <?php foreach ($model->set_map as $attribute): ?>
                <?php $attr = $attribute->map_attribute; ?>
                <?php if (!$attr->attribute_in_price) $this->renderPartial('_attribute_view', array('model' => $attr)); ?>
                <?php endforeach; ?>
                <li>
                    <span class="add_paket add_attr" title="Добавить характеристику">+</span>
                </li>
            </ul>
            <div class="clear"></div>
        </div>

        <p class="text_header">Дополнительно</p>

        <div class="text_block">
            <ul class="inline_block sorter">
                <li>
                    <div class="name">
                        <p>По возрасту</p>
                    </div>
                    <input class="attribute" type="hidden" value="age_filter">
                    <a href="#" class="triangle<?php if (!$model->age_filter) echo ' vain' ?> sort-attr"></a>
                </li>
                <li>
                    <div class="name">
                        <p>По полу</p>
                    </div>
                    <input class="attribute" type="hidden" value="sex_filter">
                    <a href="#" class="triangle<?php if (!$model->sex_filter) echo ' vain' ?> sort-attr"></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- .centered -->