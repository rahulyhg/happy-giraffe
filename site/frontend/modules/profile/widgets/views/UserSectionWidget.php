<?php
/**
 * @var UserSectionWidget $this
 * @var \User $user
 */
?>

<section class="userSection visible-md-block">
    <div class="userSection_hold">
        <div class="userSection_left">
            <h2 class="userSection_name"><?=$user->getFullName()?></h2>
            <?php if ($user->birthday): ?>
                <div class="margin-b5 clearfix"><?=$user->getNormalizedAge() ?>, <?=$user->birthdayString?></div>
            <?php endif; ?>
            <?php if (!empty($user->address->country_id)): ?>
            <div class="location locationsmall clearfix">
                <?=$user->address->getFlag(false, 'span')?>
                <?php if (!empty($user->address->city_id) || !empty($user->address->region_id)): ?>
                    <span class="location_tx"><?=$user->address->getUserFriendlyLocation()?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="userSection_btn-hold clearfix">
                <!--
                виды кнопок друзья
                userSection_btn__friend
                userSection_btn__friend-add
                userSection_btn__friend-added
                userSection_btn__friend-append
                -->

                <!--<a href="" class="userSection_btn userSection_btn__friend-add powertip"><span class="userSection_ico"></span></a>-->
                <a href="<?=Yii::app()->user->isGuest ? '#loginWidget' : Yii::app()->createUrl('/messaging/default/index', array('interlocutorId' => $user->id))?>" class="userSection_btn userSection_btn__dialog"><span class="userSection_ico"></span></a>
            </div>
        </div>
        <div class="userSection_center">
            <div class="userSection_center-reg">с Веселым Жирафом <?=$user->withUs()?></div>
            <div class="b-ava-large b-ava-large__nohover">
                <div class="b-ava-large_ava-hold">
                    <?php $this->widget('Avatar', array('user' => $user, 'size' => Avatar::SIZE_LARGE, 'largeAdvanced' => false)); ?>
                </div>
                <?php if ($user->online): ?>
                    <span class="b-ava-large_online">На сайте</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="userSection_right">
            <?php $this->widget('profile.widgets.FamilyWidget', array('user' => $user)); ?>
        </div>
    </div>
    <div class="userSection_panel">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array(
                'class' => 'userSection_panel-ul',
            ),
            'itemCssClass' => 'userSection_panel-li',
            'items' => array(
                array(
                    'label' => 'Анкета',
                    'url' => array('/profile/default/index', 'user_id' => $user->id),
                    'linkOptions' => array('class' => 'userSection_panel-a'),
                ),
                array(
                    'label' => 'Семья',
                    'url' => array('/family/default/index', 'userId' => $user->id),
                    'linkOptions' => array('class' => 'userSection_panel-a'),
                ),
                array(
                    'label' => 'Блог',
                    'url' => array('/blog/default/index', 'user_id' => $user->id),
                    'linkOptions' => array('class' => 'userSection_panel-a'),
                    'active' => Yii::app()->controller->module !== null && in_array(Yii::app()->controller->module->id, array('posts', 'blog')),
                ),
                array(
                    'label' => 'Фото',
                    'url' => array('/photo/default/index', 'userId' => $user->id),
                    'linkOptions' => array('class' => 'userSection_panel-a'),
                    'active' => Yii::app()->controller->module !== null && Yii::app()->controller->module->id == 'photo',
                ),
            ),
        ));
        ?>
    </div>
</section>