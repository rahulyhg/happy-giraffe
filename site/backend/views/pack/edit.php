<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Администратор</title>

    <link href="/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="/css/general.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

    <script type="text/javascript" src="/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="/js/jquery.tooltip.js"></script>
    <script type="text/javascript" src="/js/jquery.selectBox.min.js"></script>
    <link href="/css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css"/>
    <link href="/css/jquery.selectBox.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="/js/common.js"></script>

    <!--[if IE 6]>
    <script type="text/javascript" src="/js/DD_belatedPNG_0.0.8a-min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#select1, #select2, #select3").selectBox();
        });
    </script>
</head>
<body>
<div id="wrapper">
<div class="header">
    <a href="#" class="logo" title="Обновить страницу">Администратор</a>
    <!-- .logo -->
    <ul class="logged">
        <li>Анастасия Петрова</li>
        <li><a href="#">Выйти</a></li>
    </ul>
    <ul class="going">
        <li>Перейти в</li>
        <li><a href="#">Клуб</a></li>
        <li>|</li>
        <li><a href="#">Магазин</a></li>
    </ul>
    <ul class="header_nav">
        <li><a href="#">Клуб</a></li>
        <li class="active"><a href="#">Магазин</a></li>
    </ul>
</div>
<!-- .header -->
<div class="navigation">
    <ul>
        <li><a href="#"><span>Главная</span></a></li>
        <li class="submenu active">
            <a href="#"><span>Категории</span></a>
            <ul>
                <li><a href="#"><span>Категории</span></a></li>
                <li><a href="#"><span>Пакеты свойств</span></a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><span>Товары</span></a>
            <ul>
                <li><a href="#"><span>Товары</span></a></li>
                <li><a href="#"><span>Бренды</span></a></li>
            </ul>
        </li>
        <li><a href="#"><span>Скидки</span></a></li>
        <li><a href="#"><span>Оплата</span></a></li>
        <li><a href="#"><span>Доставка</span></a></li>
        <li><a href="#"><span>Заказы</span></a></li>
    </ul>
    <div class="clear"></div>
    <!-- .clear -->
</div>
<!-- .navigation -->

<script type="text/javascript">
    var set_id = <?php echo $model->set_id ?>;
    $(function () {
        $('body').delegate('.add_attr', 'click', function () {
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("pack/CreateAttribute") ?>',
                type:'POST',
                success:function (data) {
                    $(this).parent('li.add_attribute').append(data);
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
    });

    $('body').delegate('#attribute-form input[type=submit]', 'click', function () {
        $.ajax({
            url:'<?php echo Yii::app()->createUrl("pack/CreateAttribute") ?>',
            data:$('#attribute-form').serialize(),
            type:'POST',
            dataType:'JSON',
            success:function (data) {
                if (data !== null && data.hasOwnProperty('success'))
                    if (data.success)
                        $(this).parent('p').parent('form').remove();
            },
            context:$(this)
        });

        return false;
    });

    $('body').delegate('p.triangle', 'click', function(){
        var attr_id = $(this).parent('li').attr('obj_id');
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("pack/attributeInSearch") ?>',
            data: 'id='+attr_id,
            type: 'GET',
            success: function(data) {
                if (data == '1')
                    $(this).toggleClass('vain');
            },
            context: $(this)
        });
    });

    $('body').delegate('a.attr_del', 'click', function(){
        var answer = confirm("Удалить атрибут?");
        var attr_id = $(this).parents('li.set_attr_li').attr('obj_id');
        if (answer){
            $.ajax({
                url: '<?php echo Yii::app()->createUrl("pack/DeleteAttribute") ?>',
                data: {
                    set_id:set_id,
                    id:attr_id
                },
                type: 'GET',
                success: function(data) {
                    if (data == '1')
                        $(this).parents('li.set_attr_li').remove();
                },
                context: $(this)
            });
        }

        return false;
    });

</script>
    <?php
    /**
     * @var AttributeSet $model
     */
    ?>
<div class="content">
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
                <li>
                    <div class="name">
                        <p>Цена</p>
                        <a href="#" class="edit"></a>
                        <a href="#" class="delete"></a>
                    </div>
                    <p class="triangle"></p>

                    <p class="type">Список</p>
                </li>
                <li class="add_attribute">
                    <span class="add_paket" title="Добавить характеристику">+</span>

                </li>
            </ul>
            <div class="clear"></div>
        </div>

        <p class="text_header">Характеристики</p>
        <?php $attributes = $model->set_map ?>

        <div class="text_block">
            <ul class="inline_block">
                <?php foreach ($attributes as $attribute): ?>
                <?php $attr = Attribute::model()->findByPk($attribute->map_attribute_id);
                /**
                 * @var Attribute $attr
                 */
                ?>
                    <li class="set_attr_li" obj_id="<?php echo $attr->attribute_id ?>">
                        <?php $this->widget('SimpleFormInputWidget',array(
                        'model'=>$attr,
                        'attribute'=>'attribute_title'
                    ))?>
                        <p class="triangle<?php if (!$attr->attribute_is_insearch) echo ' vain' ?>"></p>

                        <p class="type"><?php echo $attr->getType() ?></p>

                        <?php if ($attr->attribute_type == Attribute::TYPE_ENUM):?>
                            <ul class="list-elems">
                                <?php foreach ($attr->value_map as $attr_val): ?>
                                    <li>
                                        <?php $this->widget('SimpleFormInputWidget',array(
                                        'model'=>$attr_val->map_value,
                                        'attribute'=>'value_value'
                                        ))?>
                                    </li>
                                <?php endforeach; ?>
                                <li>
                                    <?php $this->widget('SimpleFormAddWidget',array(
                                            'url'=>$this->createUrl('pack/AddAttrListElem'),
                                            'model_id' => $attr->attribute_id,
                                    ))?>
                                </li>
                            </ul>
                        <?php endif ?>
                    </li>
                <?php endforeach; ?>
                <li>
                    <span class="add_paket add_attr" title="Добавить характеристику">+</span>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <!-- .centered -->
</div>
<!-- .content -->
<div class="clear"></div>
<!-- .clear -->
<div class="empty"></div>
<!-- .empty -->
<div class="footer">
    <span>&copy; Все права защищены.</span>
</div>
<!-- .footer -->
</div>
<!-- #wrapper -->
<div style="display:none">
    <div id="delete_attribute" class="popup">
        <a href="javascript:void(0);" onclick="$.fancybox.close();" class="popup-close">Закрыть</a>

        <div class="popup_question">
            <form action="">
                <span>Вы уверены, что хотите удалить характеристику?</span>
                <ul>
                    <li><input type="button" class="disagree" value="Отказаться"/></li>
                    <li><input type="button" class="agree" value="Да"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>