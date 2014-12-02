<?php
    $photosIds = array();
    foreach ($action->data as $photo)
        $photosIds[] = $photo['id'];
    $criteria = new CDbCriteria(array(
        'with' => array(
            'photos' => array(
                'order' => 'RAND()',
            ),
            'photoCount',
        ),
        'condition' => 't.id = :album_id',
        'params' => array(':album_id' => $action->blockData['album_id']),
    ));
    $criteria->addInCondition('photos.id', $photosIds);
    $album = Album::model()->find($criteria);
?>

<?php if ($album !== null && ! empty($album->photos)): ?>
    <div class="user-albums list-item">
        <?=$this->renderPartial('activity/_activity_friend', array('user_id' => $action['user_id'], 'type' => $type))?>

        <div class="box-title"><?=($users[$action->user_id]->gender == 1) ? 'Добавил' : 'Добавила'?> новые фото</div>

        <div class="added-to"><span>в альбом</span> <?=CHtml::link($album->title, $album->url)?></div>

        <div class="added-date"><?=Yii::app()->dateFormatter->format("dd MMMM yyyy, HH:mm", end(array_values($album->photos))->created)?></div>

        <ul>
            <li><div class="clearfix">
                <div class="preview">
                    <?php $i = 0; foreach ($album->photos as $p): ?>
                        <?=CHtml::image($p->getPreviewUrl(180, 180), null, array('class' => 'img-' . ++$i ))?>
                    <?php endforeach; ?>
                </div>
                <?php $label = ($album->photoCount > count($album->photos)) ? 'еще ' . ($album->photoCount - count($album->photos)) . ' фото' : 'Смотреть' ?>
                <?=CHtml::link('<i class="icon"></i>' . $label, array('albums/user', 'id' => $action->user_id), array('class' => 'more'))?>
            </div>
            </li>
        </ul>

    </div>
<?php endif; ?>