<?php
    $categories = CookDecorationCategory::model()->findAll();

    $entity_id = ($id) ? $category->id : null;

    $js = '
        var $container = $(\'#decorlv .items\');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : \'li\',
                columnWidth: 240,
                saveOptions: true,
                singleMode: false,
                resizeable: true
            });
        });
    ';

    Yii::app()->clientScript
        ->registerScript('photo_gallery_entity_id', 'var photo_gallery_entity_id = "' . $entity_id . '";')
        ->registerScript('cook_decor_list', $js)
        ->registerScriptFile('/javascripts/jquery.masonry.min.js')
    ;

?>

<div id="dishes">

    <div class="title">

        <h2>Оформление <span>блюд</span></h2>

    </div>

    <div class="dishes-cats clearfix">

        <ul>
            <li>
                <span class="valign"></span>
                <a href="<?=CHtml::normalizeUrl(array('index'))?>" class="cook-cat <?php if (!$id) {
                    echo 'active';
                }?>">
                    <i class="icon-cook-cat icon-dish-0"></i>
                    <span>Все</span>
                </a>
            </li>
            <?php
            foreach ($categories as $c) {
                $active = ($id == $c->id) ? 'active' : '';
                ?>
                <li>
                    <span class="valign"></span>
                    <a href="<?=CHtml::normalizeUrl(array('index', 'id' => $c->id));?>" class="cook-cat <?=$active;?>">
                        <i class="icon-cook-cat icon-dish-<?=$c->id;?> active"></i>
                        <span><?=$c->title;?></span>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>

    </div>

    <div class="dishes-list">

        <div class="block-title">

            <?php if (!Yii::app()->user->isGuest) { ?>
            <div class="add-photo">
                <?php
                    $fileAttach = $this->beginWidget('application.widgets.fileAttach.FileAttachWidget', array(
                        'model' => new CookDecoration(),
                        'customButton' => true,
                        'customButtonHtmlOptions' => array('class' => 'btn-green btn-h55 fancy'),
                    ));
                ?>
                    Добавить фото
                <?php
                    $this->endWidget();
                ?>
                <div class="dishes_add-photo_hint">Нашли интересное оформление или хотите похвастаться своим творением</div>
            </div>
            <?php } ?>

            <?='<h1>' . (($id) ? 'Как можно оформить ' . $category->title_h1 : 'Тысяча лучших оформлений блюд') . '</h1>';?>

        </div>

        <div class="gallery-photos-new cols-4 clearfix">


            <?php


            $this->widget('zii.widgets.CListView', array(
                'cssFile'=>false,
                'id' => 'decorlv',
                'dataProvider' => $dataProvider,
                'itemView' => '_decoration',
                'itemsTagName' => 'ul',
                'template' => "{items}\n{pager}",
                'pager' => array(
                    'header' => '',
                    'class' => 'ext.infiniteScroll.IasPager',
                    'rowSelector' => 'li',
                    'listViewId' => 'decorlv',
                    'options' => array(
                        'scrollContainer' => new CJavaScriptExpression("$('.layout-container')"),
                        'onLoadItems' => new CJavaScriptExpression("function(items) {
                            $(items).hide();
                            $('#decorlv .items').append(items).imagesLoaded(function() {
                                 $('#decorlv .items').masonry('appended', $(items));
                                 " . $this->pGallery . "
                                 $(items).fadeIn();
                            });
                            $('img.lazy').lazyload({
                                threshold : 200,
                                effect : 'fadeIn',
                                container: $('.layout-container')
                            });
                            return false;
                        }"),
                    ),
                ),
            ));
            ?>


        </div>

    </div>

</div>

<script type="text/javascript">
    $("img.lazy").lazyload({
        threshold : 200,
        effect : "fadeIn",
        container: $(".layout-container")
    });
    $(function() {
        if (typeof twttr == 'undefined')
            window.twttr = (function (d, s, id) {
                var t, js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
                return window.twttr || (t = { _e:[], ready:function (f) {
                    t._e.push(f)
                } });
            }(document, "script", "twitter-wjs"));
    });
</script>
<?php

Yii::app()->clientScript
    ->registerScriptFile('http://vk.com/js/api/share.js?11')
    ->registerCssFile('http://stg.odnoklassniki.ru/share/odkl_share.css')
    ->registerScriptFile('http://stg.odnoklassniki.ru/share/odkl_share.js');

?>





