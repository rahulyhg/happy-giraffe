<?php
$albumsCount = count($albums = $this->user->getRelated('albums', true, array('scopes' => array('noSystem'))));
$albums = $this->user->getRelated('albums', true, array('limit' => 2, 'scopes' => array('noSystem')));
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/stylesheets/user.css');
?>
<div class="user-albums">
    <div class="box-title">
        <?php if(!Yii::app()->user->isGuest && $this->user->id == Yii::app()->user->id): ?>
            <?php
                Yii::import('application.controllers.AlbumsController');
                AlbumsController::loadUploadScritps();
                $link = Yii::app()->createUrl('/albums/addPhoto')
            ?>
            <a class="btn btn-orange-smallest a-right fancy" href="<?php echo $link; ?>"><span><span>Добавить фото</span></span></a>
        <?php endif; ?>
        Фото
        <?php echo $albumsCount > 2 ? CHtml::link('Все альбомы (' . $albumsCount . ')', array('/albums/user', 'id' => $this->user->id)) : ''; ?>
    </div>
    <ul>
        <?php foreach($albums as $album): ?>
            <?php if(count($album->photos) == 0) continue; ?>
            <li>
                <big>Альбом &#171;<?php echo $album->title; ?>&#187;</big>
                <div class="clearfix">
                    <div class="preview">
                        <?php $index = 1; ?>
                        <?php foreach($album->getRelated('photos', true, array('limit' => 3)) as $photo): ?>
                            <?php echo CHtml::link(CHtml::image($photo->getPreviewUrl(180, 180), '', array('class' => 'img-' . $index)), array('/albums/photo', 'id' => $photo->id)); ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php if(($count = count($album->photos)) > 3): ?>
                        <a class="more" href="<?php echo Yii::app()->createUrl('albums/view', array('id' => $album->id)); ?>"><i class="icon"></i>еще <?php echo $count - 3; ?> фото</a>
                    <?php else: ?>
                        <a class="more" href="<?php echo Yii::app()->createUrl('albums/view', array('id' => $album->id)); ?>"><i class="icon"></i>смотреть</a>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>