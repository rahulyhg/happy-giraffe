<?php

$author = $widget->getUserInfo($data->dataArray['content']['authorId']);

?>
<div class="b-article_in clearfix">
    <div class="comments comments__buble comments__anonce">
        <div class="comments_hold">
            <div class="comments_li comments_li__lilac">
                <div class="comments_i clearfix">
                    <div class="comments_frame">
                        <div onclick="location.href='<?=$data->dataArray['url']?>'" class="comments_link">
                            <div class="comments_cont">
                                <div class="wysiwyg-content">
                                    <?= $data->dataArray['text'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b-post-anonce-s">
        <?php if ($data->dataArray['content']['cover']) {
            ?><div class="b-post-anonce-s_img"><img src="<?= $data->dataArray['content']['cover'] ?>" alt="Заголовок статьи"></div><?php
        }
        ?>
        <div class="b-post-anonce-s_hold">
            <div class="b-post-anonce-s_header clearfix">
                <a href="<?= $author->profileUrl ?>" class="ava ava__<?= $author->gender ? '' : 'fe' ?>male ava__small">
                    <span class="ico-status ico-status__online"></span>
                    <img alt="" src="<?= $author->avatarUrl ?>" class="ava_img">
                </a>
                <a href="<?= $author->profileUrl ?>" class="b-post-anonce-s_author"><?= $author->fullName ?></a>
                <?= HHtml::timeTagByOptions($data->dataArray['content']['dtimeCreate'], array('id' => 'activityCommentTime' . $data->id, 'class' => 'tx-date')) ?>
            </div>
            <a href="<?= $data->dataArray['content']['url'] ?>" class="b-post-anonce-s_t"><?= $data->dataArray['content']['title'] ?></a>
        </div>
    </div>
</div>