<div class="b-article_in clearfix">
    <div class="user-status user-status__base">
        <div class="user-status_hold">
            <a class="user-status_tx" href="<?= $content->url ?>"><?= strip_tags($content->status->text) ?></a>
        </div>
        <?php if ($content->status->mood) { ?>
            <div class="user-status_bottom">
                <div class="b-user-mood">
                    <div class="b-user-mood_hold">
                        <div class="b-user-mood_tx">Мое настроение -</div>
                    </div>
                    <div class="b-user-mood_img">
                        <img src="/images/widget/mood/<?= $content->status->mood_id ?>.png">
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>