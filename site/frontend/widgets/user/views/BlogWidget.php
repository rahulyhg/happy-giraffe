<div class="user-blog">
    <div class="box-title">
        <a class="btn btn-orange-smallest a-right" href="<?php echo Yii::app()->controller->createUrl('blog/add'); ?>"><span><span>Добавить запись</span></span></a>
        Блог <?php if ($this->count > 4): ?><a href="<?=Yii::app()->createUrl('/blog/list', array('user_id' => $user->id)) ?>">Все записи (<?=$this->count?>)</a><?php endif; ?>
    </div>
    <ul>
        <?php foreach ($this->user->blogWidget as $post): ?>
            <li>
                <a href="<?=$post->getUrl() ?>"><?=$post->title ?></a>
                <div class="date"><?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy, HH:mm", $post->created); ?></div>
                <p><?=$post->short?></p>
            </li>
        <?php endforeach; ?>

    </ul>
</div>