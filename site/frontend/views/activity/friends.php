<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/javascripts/jquery.jcarousel.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/javascripts/find_friends.js');
?>

<div id="find-friend" class="activity-find-friend">

    <div class="title">Найти <span>друзей</span><?php if(count($friends) > 12): ?> <a href="javascript:void(0);" onclick="nextFriendsPage();"><span>Найти<br/>еще</span></a><?php endif; ?></div>

    <div id="find-friend-wrapper">
        <?php for($i = 0; $i < ceil(count($friends)/12); $i++): ?>
            <ul class="clearfix"<?php if ($i == 0): ?> style="display:block;"<?php endif; ?>>
                <?php for($j = $i * 12; ($j < ($i + 1) * 12) && $j < count($friends); $j++): ?>
                    <?php $this->renderPartial('application.widgets.activity.views._friend', array('f' => $friends[$j])); ?>
                <?php endfor; ?>
            </ul>
        <?php endfor; ?>
    </div>
</div>