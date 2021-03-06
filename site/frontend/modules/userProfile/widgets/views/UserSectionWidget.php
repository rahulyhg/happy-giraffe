<?php
/**
 * @var site\frontend\modules\userProfile\widgets\UserSectionWidget $this
 * @var \User $user
 */
$cs = Yii::app()->clientScript;
$cs->registerAMD('userSection', array('kow', 'extensions/avatarUpload'));
?>

<section class="userSection<?php if ($this->adaptive): ?> visible-md visible-lg<?php endif; ?>">
    <div class="userSection_hold">
        <div class="userSection_left">
            <h2 class="userSection_name"><?=$user->getFullName()?></h2>
            <?php if ($user->birthday): ?>
                <div class="margin-b5 clearfix"><?=$user->getNormalizedAge() ?>, <?=$user->birthdayString?></div>
            <?php endif; ?>
            <?php if ($user->location->countryId): ?>
            <div class="location locationsmall clearfix">
                <span class="flag flag-<?=$user->location->country->iso?>" title="<?=$user->location->country->title?>"></span>
                <?php if ($cityAndRegion = \site\frontend\modules\geo2\components\UserLocationFormatter::cityAndRegion($user->location)): ?>
                    <span class="location-tx"><?=$cityAndRegion?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($user->id !== Yii::app()->user->id): ?>
            <div class="userSection_btn-hold clearfix">
                <friends-action-button params="friendId: <?= $user->id ?>"></friends-action-button>
                <a href="<?=Yii::app()->createUrl('/messaging/default/index', array('interlocutorId' => $user->id))?>" class="userSection_btn userSection_btn__dialog registration-button powertip" title="Отправить сообщение" data-bind="follow: {}"><span class="userSection_ico"></span></a>
            </div>
            <?php endif; ?>
            <?php if ($user->id == Yii::app()->user->id): ?>
                <a href="<?=Yii::app()->createUrl('/users/default/settings')?>" class="btn btn-white btn-xm"> <span class="ico-edit ico-edit__s-white"> </span> Редактировать</a>
            <?php endif; ?>
        </div>
        <div class="userSection_center">
            <?php if ($withUs = $user->withUs()): ?>
            <div class="userSection_center-reg">с Веселым Жирафом <?=$withUs?></div>
            <?php endif; ?>
            <div class="b-ava-large b-ava-large__nohover">
                <div class="b-ava-large_ava-hold">
                    <?php $this->widget('Avatar', array(
                        'user' => $user,
                        'size' => Avatar::SIZE_LARGE,
                        'largeAdvanced' => false,
                        'htmlOptions' => array(
                            'class' => 'ava__base-xs',
                        ),
                    )); ?>
                </div>
                <?php if ($user->online): ?>
                    <span class="b-ava-large_online">На сайте</span>
                <?php endif; ?>
                <?php if ($user->id == Yii::app()->user->id): ?>
                    <a id="avatar-upload" href="#" class="i-ava-bubble i-ava-bubble__photo powertip" title='Загрузить главное фото' data-bind="avatarUpload: { data: { multiple: false } }">
                        <div class="i-ava-bubble_ico i-ava-bubble_ico__photo"></div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="userSection_right">
            <?php if (empty($user->specInfo)): ?>
                <family-section params="userId: <?= $user->id ?>"></family-section>
                <?php if (false): ?>
                    <?php $this->widget('profile.widgets.FamilyWidget', array('user' => $user)); ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="userSection__pos"><?=$user->specInfoObject->title?></div>
                <div class="userSection__desc">
                    <?=$user->specInfoObject->education?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (($this->user->id !== Yii::app()->user->id || Yii::app()->controller->route != 'userProfile/default/index') && empty($user->specInfo)): ?>
        <div class="userSection_panel">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'userSection_panel-ul clearfix',
                ),
                'itemCssClass' => 'userSection_panel-li',
                'items' => array(
                    array(
                        'label' => 'Анкета',
                        'url' => array('/userProfile/default/index', 'userId' => $user->id),
                        'linkOptions' => array('class' => 'userSection_panel-a'),
                    ),
                    array(
                        'label' => 'Семья',
                        'url' => array('/family/default/index', 'userId' => $user->id),
                        'linkOptions' => array('class' => 'userSection_panel-a'),
                        'visible' => $this->hasFamily() || ($this->user->id == \Yii::app()->user->id),
                    ),
                    array(
                        'label' => 'Блог',
                        'url' => array('/blog/default/index', 'user_id' => $user->id),
                        'linkOptions' => array('class' => 'userSection_panel-a'),
                        'active' => Yii::app()->controller->module !== null && in_array(Yii::app()->controller->module->id, array('posts', 'blog')),
                        'visible' => $this->hasBlog() || ($this->user->id == \Yii::app()->user->id),
                    ),
                    array(
                        'label' => 'Фото',
                        'url' => array('/photo/default/index', 'userId' => $user->id),
                        'linkOptions' => array('class' => 'userSection_panel-a'),
                        'active' => Yii::app()->controller->module !== null && Yii::app()->controller->module->id == 'photo',
                        'visible' => $this->hasPhotos() || ($this->user->id == \Yii::app()->user->id),
                    ),
                ),
            ));
            ?>
        </div>
    <?php endif; ?>
</section>