<?php
/**
 * @var Community $community сообщество
 * @var User[] $moderators модераторы клуба
 * @var User[] $users подписчики
 * @var int $user_count кол-во подписчиков
 * @var int $rubric_id выбранная рубрика
 */

Yii::app()->clientScript->registerScriptFile('/javascripts/ko_community.js');
?>
<?php $this->renderPartial('_top', array('breadcrumbs' => false)); ?>

<div class="b-section b-section__club b-section__green">
    <div class="b-section_hold">
        <div class="content-cols clearfix">
            <div class="col-1">
                <div class="club-list club-list__large clearfix">
                    <ul class="club-list_ul textalign-c clearfix">
                        <li class="club-list_li">
                            <a href="" class="club-list_i">
                                <span class="club-list_img-hold">
                                    <img src="/images/club/3-w240.jpg" alt="" class="club-list_img">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-23-middle clearfix js-community-subscription">

                <?php $this->renderPartial('_moderators', compact('moderators', 'community')); ?>
                <?php $this->renderPartial('_links', compact('community')); ?>

            </div>
        </div>
    </div>
</div>

<div class="content-cols clearfix">
    <div class="col-1">

        <?php $this->renderPartial('_users', compact('users', 'user_count')); ?>

        <?php $this->renderPartial('_rubrics', compact('community', 'rubric_id')); ?>

    </div>
    <div class="col-23-middle ">
        <?php $this->renderPartial('_list', compact('community', 'rubric_id')); ?>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        vm = new CommunitySubscription(<?=CJSON::encode(UserCommunitySubscription::subscribed(Yii::app()->user->id, $community->id))?>, <?=$community->id ?>);
        $(".js-community-subscription").each(function(index, el) {ko.applyBindings(vm, el)});
    });
</script>