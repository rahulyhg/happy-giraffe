<?php if (!Yii::app()->user->isGuest):?>
    <?php if (Friend::model()->areFriends(Yii::app()->user->id, $user->id)): ?>
        <span class="friend">друг</span>
        <?php if ($this->route == 'user/friends' && $this->user->id == Yii::app()->user->id): ?>
            <a href="javascript:void(0)" onclick="deleteFriend(this, <?php echo $user->id; ?>, <?=($this->route == 'user/friends') ? 'true' : 'false'?>);" class="remove tooltip" title="Удалить из друзей"></a>
        <?php endif; ?>
    <?php elseif ($user->isInvitedBy(Yii::app()->user->id)): ?>
        <a href="javascript:;" class="add-friend tooltip" title="Приглашение выслано"></a>
    <?php else: ?>
        <a href="javascript:;" onclick="sendInvite(this, <?php echo $user->id; ?>);" class="add-friend tooltip" title="Пригласить в друзья"></a>
    <?php endif; ?>
<?php else: ?>
    <a href="#loginWidget" class="add-friend popup-a" data-theme="white-square"></a>
<?php endif ?>

<?php if (false): ?>
<?php $this->widget('application.widgets.friendButtonWidget.FriendButtonWidget', array(
    'user' => $user,
)); ?>
<?php endif; ?>