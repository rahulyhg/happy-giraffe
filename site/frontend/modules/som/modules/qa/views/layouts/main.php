<?php
/**
 * @var $this site\frontend\modules\som\modules\qa\controllers\DefaultController
 * @var string $content
 * @var site\frontend\modules\som\modules\qa\widgets\ConsultationsMenu $consultationsMenu
 */
$this->beginContent('//layouts/lite/main');
Yii::beginProfile('consultations');
$consultationsMenu = $this->createWidget('site\frontend\modules\som\modules\qa\widgets\ConsultationsMenu');
Yii::endProfile('consultations');
?>

<div class="b-main clearfix">
    <div class="b-main_cont">
        <div class="b-main_col-article">
            <?=$content?>
        </div>
        <aside class="b-main_col-sidebar visible-md">
            <div class="sidebar-widget">
                <div class="btn btn-success btn-xl btn-question">Задать вопрос</div>
                <div class="personal-links">
                    <!-- ava--><span href="#" class="ava ava__middle ava__female"><img alt="" src="http://img.happy-giraffe.ru/thumbs/200x200/167771/ava9a3e33bd8a5a29146175425a5281390d.jpg" class="ava_img"></span>
                    <ul class="personal-links_ul">
                        <li class="personal-links_li"><a class="personal-links_link">Мои вопросы<span class="personal-links_count">56</span></a></li>
                        <li class="sidebar-personal_li"><a class="personal-links_link">Мои ответы<span class="personal-links_count">625</span></a></li>
                    </ul>
                </div>
                <?php Yii::beginProfile('categories'); ?>
                <div class="questions-categories">
                    <?php $this->widget('site\frontend\modules\som\modules\qa\widgets\categories\MainCategoriesMenu'); ?>
                </div>
                <?php Yii::endProfile('categories'); ?>
                <?php Yii::beginProfile('consultations'); ?>
                <?php if (count($consultationsMenu->items) > 0): ?>
                <div class="consult-widget">
                    <div class="consult-widget_heading">Онлайн-консультации</div>
                    <?php $consultationsMenu->run(); ?>
                </div>
                <?php Yii::endProfile('consultations'); ?>

                <?php Yii::beginProfile('rating'); ?>
                <?php $this->widget('site\frontend\modules\som\modules\qa\widgets\usersRating\UsersRatingWidget'); ?>
                <?php Yii::endProfile('rating'); ?>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</div>
<?php $this->endContent(); ?>