<?php
/**
 * @var $this DefaultController
 * @var $data BlogContent
 * @var $full bool
 */

$post = $data->post;
?>
<?php if ($full):?>
    <h2 class="b-article_t">
        <?=$data->title ?>
    </h2>

    <div class="b-article_in clearfix">
        <div class="wysiwyg-content clearfix">
            <div class="b-article_in-img">
                <?=$data->video->embed?>
            </div>
            <?=$data->video->purified->text ?>
        </div>
    </div>
<?php else: ?>
    <h2 class="b-article_t">
        <a href="<?=$data->getUrl() ?>" class="b-article_t-a"><?=$data->title ?></a>
    </h2>

    <div class="b-article_in clearfix">
        <div class="wysiwyg-content clearfix">
            <p><?=$data->getContentText(500, '') ?></p>
            <div class="b-article_in-img">
                <?=$data->video->embed?>
            </div>
        </div>
    </div>

    <div class="textalign-r margin-15">
        <a href="<?=$data->getUrl() ?>" class="b-article_more">Смотреть далее</a>
    </div>
<?php endif ?>