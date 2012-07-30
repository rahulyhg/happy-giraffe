<div class="entry entry-full">

    <h1><?=$data->title?></h1>

    <div class="entry-header">

        <?php
            $this->widget('application.widgets.avatarWidget.AvatarWidget', array(
                'user' => $data->author,
                'friendButton' => true,
                'location' => false,
            ));
        ?>

        <div class="meta">
            <div class="time"><?=Yii::app()->dateFormatter->format("d MMMM yyyy, H:mm", $data->created)?></div>
            <div class="seen">Просмотров:&nbsp;<span><?=PageView::model()->viewsByPath($data->url)?></span></div><br>
            <a href="<?=$data->getUrl(true)?>">Комментариев: <?php echo $data->commentsCount; ?></a>
        </div>
        <div class="clear"></div>
    </div>

    <div class="entry-content">

        <div class="disease-title">
            <span>От болезни</span> <?=CHtml::link($data->disease->title, array('/services/childrenDiseases/default/view', 'id' => $data->disease->slug))?>
        </div>

        <div class="clearfix">

            <div class="traditional-recipes-ingredients">

                <div class="block-title"><i class="icon"></i>Ингредиенты</div>

                <ul>
                    <?php foreach ($data->ingredients as $i): ?>
                    <li><?=$i->ingredient->title?> - <?=round($i->value)?> <?=HDate::GenerateNoun(array($i->unit->title, $i->unit->title2, $i->unit->title3), (int) $i->value)?></li>
                    <?php endforeach; ?>
                </ul>

            </div>

            <div class="wysiwyg-content side">

                <h3>Приготовление</h3>

                <?=$data->text?>

            </div>

        </div>

    </div>

</div>

<div class="like-block fast-like-block">

    <div class="box-1">
        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
    </div>

</div>

<div class="entry-nav clearfix">
    <?php if ($prev = $data->prev): ?>
    <div class="prev">
        <span>Предыдущий рецепт</span>
        <?=CHtml::link($prev->title, $prev->url)?>
    </div>
    <?php endif; ?>
    <?php if ($next = $data->next): ?>
    <div class="next">
        <span>Следующий рецепт</span>
        <?=CHtml::link($next->title, $next->url)?>
    </div>
    <?php endif; ?>

</div>

<?php
    $this->widget('application.widgets.commentWidget.CommentWidget', array(
        'model' => $data,
    ));
?>
