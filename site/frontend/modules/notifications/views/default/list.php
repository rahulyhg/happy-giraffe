<?php
/**
 * @var $list Notification[]
 * @var $check bool
 * @author Alex Kireev <alexk984@gmail.com>
 */
?>
<?php if (!empty($list)):?>
    <?php foreach ($list as $model) :?>
    <div class="user-notice-list_i">
        <?php $this->renderPartial('types/type_' . $model->type, compact('model', 'check')); ?>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="cap-empty cap-empty__rel">
    <div class="cap-empty_hold">
        <div class="cap-empty_tx">У вас пока нет новых уведомлений.</div>
        <span class="cap-empty_gray" href="">Будьте активны! Добавляйте записи, фото, видео.</span>
    </div>
</div>
<?php endif; ?>