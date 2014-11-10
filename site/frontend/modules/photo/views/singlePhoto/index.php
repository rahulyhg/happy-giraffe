<?php
/**
 * @var \LiteController $this
 * @var site\frontend\modules\photo\models\PhotoAttach $attach
 * @var site\frontend\modules\photo\models\PhotoAttach $attachNext
 * @var site\frontend\modules\photo\models\PhotoAttach $attachPrev
 * @var site\frontend\modules\photo\models\PhotoCollection|site\frontend\modules\photo\components\IPublicPhotoCollection $collection
 */
$photo = $attach->photo;
$this->breadcrumbs += array(
    $collection->getTitle() => $collection->getUrl(),
    $attach->getTitle(),
);
$this->pageTitle = $attach->getTitle() . ' - ' . $collection->getTitle();
$this->metaDescription = $photo->description;
$this->metaCanonical = $collection->getUrl();
if ($attachPrev !== null) {
    $this->metaNavigation->prev = $attachPrev->getUrl();
}
if ($attachNext !== null) {
    $this->metaNavigation->next = $attachNext->getUrl();
}
$commentsWidget = $this->createWidget('site\frontend\modules\comments\widgets\CommentWidget', array('model' => $photo));
$cs = Yii::app()->clientScript;
$cs->registerAMD('photo-single', array('kow'));
?>

<div class="b-main">
    <div class="b-main_cont">
        <div class="b-main_col-hold clearfix">
            <div class="b-main_col-article">
                <!-- b-article-->
                <div class="b-article clearfix">
                    <div class="b-article_header clearfix">
                        <div class="icons-meta"><a href="" class="icons-meta_comment"><span class="icons-meta_tx"><?=$commentsWidget->count?></span></a>
                            <div class="icons-meta_view"><span class="icons-meta_tx"><?=$this->getViews()?></span></div>
                        </div>
                        <div class="float-l">
                            <?php $this->widget('Avatar', array('user' => $photo->author)); ?>
                            <div class="b-article_author"><a href="<?=$photo->author->getUrl()?>" class="a-light"><?=$photo->author->getFullName()?></a></div>

                        </div>
                    </div>
                    <h1 class="b-article_t"><?=$attach->getTitle()?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b-main_cont b-main_cont__wide">
    <!-- b-album-->
    <section class="b-album b-album__photolink">
        <div class="b-album_img-hold">
            <div class="b-album_img-a">
                <div class="verticalalign-m-help"></div>
                <div class="verticalalign-m-el">
                    <?=CHtml::image(Yii::app()->thumbs->getThumb($photo, 'myPhotosAlbumCover')->getUrl(), $attach->getTitle())?>
                </div>
            </div>

            <div class="b-album_img-hold-ovr">
                <div class="ico-zoom ico-zoom__abs"></div>
            </div>

            <?php if ($attachPrev !== null): ?>
                <a href="<?=$attachPrev->getUrl()?>" class="i-photo-arrow i-photo-arrow__l i-photo-arrow__abs"></a>
            <?php endif; ?>

            <?php if ($attachNext !== null): ?>
                <a href="<?=$attachNext->getUrl()?>" class="i-photo-arrow i-photo-arrow__r i-photo-arrow__abs"></a>
            <?php endif; ?>
        </div>
    </section>
</div>

<div class="b-main_cont">
    <div class="b-main_col-hold clearfix">
        <div class="b-main_col-article">
        <!-- b-article-->
        <div class="b-article clearfix">
            <div class="wysiwyg-content">
                <p><?=$photo->description?></p>
            </div>
        </div>
        <!--<div class="textalign-c visible-md-block">
            <div class="like-control like-control__line">
                <div class="like-control_hold"><a href="" title="Нравится" class="like-control_i like-control_i__like powertip">
                        <div class="like-control_t">Мне нравится!</div>
                        <div class="ico-action-hg ico-action-hg__like"></div>
                        <div class="like-control_tx">865</div></a></div>
                <div class="like-control_hold"><a href="" title="В избранное" class="like-control_i like-control_i__idea powertip">
                        <div class="like-control_t">В закладки</div>
                        <div class="ico-action-hg ico-action-hg__favorite"></div>
                        <div class="like-control_tx">863455</div></a></div>
            </div>
         /div>-->
        <?php $this->widget('application.widgets.yandexShareWidget.YandexShareWidget', array('model' => $photo, 'lite' => true)); ?>
        <!-- Реклама яндекса-->
        <?php $this->renderPartial('//banners/_direct_others'); ?>
        <!-- comments-->
        <section class="comments comments__buble">
            <div class="comments-menu">
                <ul data-tabs="tabs" class="comments-menu_ul">
                    <li class="comments-menu_li active"><a href="#commentsList" data-toggle="tab" class="comments-menu_a comments-menu_a__comments">Комментарии <?=$commentsWidget->count?> </a></li>
                    <!--<li class="comments-menu_li"><a href="#likesList" data-toggle="tab" class="comments-menu_a comments-menu_a__likes">Нравится 865</a></li>
                    <li class="comments-menu_li"><a href="#favoritesList" data-toggle="tab" class="comments-menu_a comments-menu_a__favorites">Закладки 865</a></li>-->
                </ul>
            </div>
            <div class="tab-content">
                <?php $commentsWidget->run(); ?>
                <!--<div id="likesList" class="comments_hold tab-pane">
                    <div class="list-subsribe-users">
                        <ul class="list-subsribe-users_ul">
                            <li class="list-subsribe-users_li">
                                <a href="#" class="ava ava__middle"><span class="ico-status ico-status__online"></span><img alt="" src="http://img.happy-giraffe.ru/thumbs/200x200/167771/ava9a3e33bd8a5a29146175425a5281390d.jpg" class="ava_img"></a><a class="a-light">Ангелина Богоявленская</a>
                                <time datetime="1957-10-04" class="tx-date">Сегодня 13:25</time><a class="btn btn-secondary btn-sl">Читаю</a>
                            </li>
                            <li class="list-subsribe-users_li">
                                <a href="#" class="ava ava__middle"><span class="ico-status ico-status__online"></span><img alt="" src="http://img.happy-giraffe.ru/thumbs/200x200/167771/ava9a3e33bd8a5a29146175425a5281390d.jpg" class="ava_img"></a><a class="a-light">Ангелина Богоявленская</a>
                                <time datetime="1957-10-04" class="tx-date">Сегодня 13:25</time><a class="btn btn-success btn-sl"><span class="ico-plus"></span>Подписаться</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="favoritesList" class="comments_hold tab-pane">
                    <div class="list-subsribe-users">
                        <ul class="list-subsribe-users_ul">
                            <li class="list-subsribe-users_li">
                                <a href="#" class="ava ava__middle"><span class="ico-status ico-status__online"></span><img alt="" src="http://img.happy-giraffe.ru/thumbs/200x200/167771/ava9a3e33bd8a5a29146175425a5281390d.jpg" class="ava_img"></a><a class="a-light">Ангелина Богоявленская</a>
                                <time datetime="1957-10-04" class="tx-date">Сегодня 13:25</time><a class="btn btn-success btn-sl"><span class="ico-plus"></span>Подписаться</a>
                            </li>
                            <li class="list-subsribe-users_li">
                                <a href="#" class="ava ava__middle"><span class="ico-status ico-status__online"></span><img alt="" src="http://img.happy-giraffe.ru/thumbs/200x200/167771/ava9a3e33bd8a5a29146175425a5281390d.jpg" class="ava_img"></a><a class="a-light">Ангелина Богоявленская</a>
                                <time datetime="1957-10-04" class="tx-date">Сегодня 13:25</time><a class="btn btn-secondary btn-sl">Читаю</a>
                            </li>
                        </ul>
                    </div>
                </div>-->
            </div>
        </section>
        <!-- /comments-->
        </div>
    </div>
</div>