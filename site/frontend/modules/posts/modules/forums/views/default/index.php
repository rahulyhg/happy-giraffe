<?php
/**
 * @var site\frontend\modules\posts\modules\forums\controllers\DefaultController $this
 */
$this->pageTitle = 'Форумы';
$breadcrumbs = [
    'Главная' => ['/site/index'],
    'Форумы',
];
?>

<?php $this->beginClip('home'); ?>
<?php if (Yii::app()->user->isGuest): ?>
<div class="homepage-clubs_b">
    <div class="homepage-clubs_btn-hold"><a class="w-240 btn btn-xl green-btn fontweight-b login-button" data-bind="follow: {}">Начать общаться</a></div>
</div>
<?php endif; ?>
<?php $this->endClip(); ?>

<div class="homepage homepage_adaptive">
    <div class="b-breadcrumbs">
        <?php $this->widget('zii.widgets.CBreadcrumbs', [
            'links' => $breadcrumbs,
            'tagName' => 'ul',
            'homeLink' => false,
            'separator' => '',
            'activeLinkTemplate' => '<li><a class="b-breadcrumbs__home" href="{url}">{label}</a></li>',
            'inactiveLinkTemplate' => '<li>{label}</li>',
        ]); ?>
    </div>
    <section class="b-top-blocks">
        <ul class="list">
            <li class="item sidebar-widget_item b-widget-wrapper_bordergrunt b-widget-wrapper_outline">
                <?php $this->widget('site\frontend\modules\posts\modules\forums\widgets\hotPosts\HotPostsWidget', [
                    'labels' => [
                        \site\frontend\modules\posts\models\Label::LABEL_FORUMS,
                    ],
                ]); ?>
            </li>
            <li class="item conversion b-widget-wrapper_border">
                <div class="item__img item__img_margin"></div>
                <p>самые актуальные темы для мам и пап</p>
                <?php if (Yii::app()->user->isGuest): ?>
                    <a class="btn btn-xl green registration-button" data-bind="follow: {}">Присоеденяйтесь!</a>
                <?php endif; ?>
            </li>
            <li class="item statistik sidebar-widget_item">
                <?php $this->widget('\site\frontend\modules\posts\modules\forums\widgets\usersTop\UsersTopWidget', [
                    'labels' => [
                        \site\frontend\modules\posts\models\Label::LABEL_FORUMS,
                    ],
                ]); ?>
            </li>
        </ul>
    </section>
    <div class="homepage__title_comment-wrapper">
        <div class="homepage__title_comment">Форумы</div>
    </div>
    <?php $this->renderPartial('//site/_home_clubs'); ?>
    <?php $this->widget('site\frontend\modules\posts\modules\forums\widgets\lastPost\LastPostWidget'); ?>
    <?php $this->widget('site\frontend\modules\posts\modules\forums\widgets\onlineUsers\OnlineUsersWidget'); ?>
    <div class="text-center visible-md">
        <a href="<?=Yii::app()->controller->createUrl('/friends/search/index')?>" class="w-240 btn btn-xl green-btn fontweight-b registration-button" data-bind="follow: {}">Найти друзей</a>
    </div>
</div>