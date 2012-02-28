<div class="item" id="CommunityComment_<?php echo $data->id; ?>">
    <div class="clearfix">
        <div class="user">
            <?php $this->widget('AvatarWidget', array('user' => $data->author)); ?>
            <a class="username"><?php echo $data->author->first_name; ?></a>
        </div>
        <div class="text">
            <div class="comment-content"><?php echo $data->text; ?></div>
    
            <div class="data">
                <?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy, HH:mm", $data->created); ?>
                <?php
                if ($data->author->id != Yii::app()->user->id) {
                    $report = $this->beginWidget('site.frontend.widgets.reportWidget.ReportWidget', array('model' => $data));
                    $report->button("$(this).parents('.item')");
                    $this->endWidget();
                }
                ?>
            </div>
            <?php if ($data->author->id == Yii::app()->user->id || Yii::app()->authManager->checkAccess('edit comment',Yii::app()->user->getId())): ?>
            <?php echo CHtml::link('редактировать', '#', array('class' => 'edit-comment')); ?>
            <?php endif; ?>
            <?php if ($data->author->id == Yii::app()->user->id || Yii::app()->authManager->checkAccess('delete comment', Yii::app()->user->getId())): ?>
            <?php echo CHtml::link('удалить', Yii::app()->createUrl('#', array('id' => $data->id)), array(
                'class' => 'remove-comment',
            )); ?>
            <?php endif; ?>
            <a href="javascript:void(0)" onclick="Comment.response(this);">Ответить</a>
        </div>
    </div>
</div>