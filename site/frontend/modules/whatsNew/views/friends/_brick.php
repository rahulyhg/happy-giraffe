<li class="masonry-news-list_item">
    <div class="masonry-news-list_friend-info clearfix">
        <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array(
            'user' => $data->user,
            'small' => true,
            'size' => 'small',
        )); ?>
        <div class="details">
            <a class="username" href="<?=$data->user->url?>"><?=$data->user->first_name?></a>
            <span class="date"><?=HDate::GetFormattedTime($data->updated)?></span>
            <p><?=$data->label?></p>
        </div>
    </div>
    <?php $this->renderPartial($data->view, compact('data')); ?>
</li>