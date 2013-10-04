<?php
/**
 * @var $this DefaultController
 * @var $data BlogContent
 * @var $full bool
 */
//if (!empty($data->real_time))
//$data->created = $data->real_time;
if (empty($data->source_id))
    $source = $data;
else
    $source = $data->source;

if ($full) {
    if (empty($this->meta_description)){
        if (empty($data->meta_description))
            $this->meta_description = $data->meta_description_auto;
        else
            $this->meta_description = $data->meta_description;
    }
}

?>
<div class="b-article clearfix<?php if ($data->type_id == CommunityContentType::TYPE_STATUS) echo ' b-article__user-status' ?>" id="blog_settings_<?=$data->id ?>">
    <?php if ($data->source_id) $this->renderPartial('blog.views.default._repost', array('data' => $data)); ?>
    <div class="float-l">
        <?php $this->renderPartial('blog.views.default._post_controls', array('model' => $data->getSourceContent(), 'isRepost' => !empty($data->source_id), 'contestWork' => isset($contestWork) ? $contestWork : null)); ?>
    </div>

    <div class="b-article_cont clearfix">
        <div class="b-article_cont-tale"></div>

        <div class="b-article_removed" style="display: none;" data-bind="visible: removed()">
            <div class="b-article_removed-hold">
                <div class="b-article_removed-tx">Ваша запись удалена!</div>
                <a class="b-article_removed-a" data-bind="click: restore">Восстановить</a>
            </div>
        </div>

        <!-- ko stopBinding: true -->
        <?php $this->renderPartial('blog.views.default._post_header', array('model' => $source, 'full' => $full)); ?>

        <?php $this->renderPartial('blog.views.default.types/type_' . $source->type_id, array('data' => $source, 'full' => $full, 'showTitle' => empty($data->source_id) ? true : false, 'show_new' => isset($show_new) ? true : false)); ?>

        <?php if ($full) $this->renderPartial('blog.views.default._likes', array('data' => $source)); ?>

        <?php if ($data->type_id == CommunityContent::TYPE_STATUS): ?><div class="bg-white clearfix"><?php endif; ?>
        <?php if ($full) $this->renderPartial('blog.views.default._prev_next', compact('data')); ?>
        <?php if ($data->type_id == CommunityContent::TYPE_STATUS): ?></div><?php endif; ?>

        <?php if ($full): ?>
            <!-- ﬂÌ‰ÂÍÒ.ƒËÂÍÚ -->
            <div id="yandex_ad" style="padding: 20px 20px 30px; background: #fffff0; margin-top: -20px;">
                <!-- ﬂÌ‰ÂÍÒ.ƒËÂÍÚ -->
                <div id="yandex_ad"></div>
                <script type="text/javascript">
                    (function(w, d, n, s, t) {
                        w[n] = w[n] || [];
                        w[n].push(function() {
                            Ya.Direct.insertInto(87026, "yandex_ad", {
                                site_charset: "utf-8",
                                ad_format: "direct",
                                font_size: 1.2,
                                type: "vertical",
                                limit: 2,
                                title_font_size: 3,
                                site_bg_color: "FFFFFF",
                                title_color: "0066CC",
                                url_color: "006600",
                                text_color: "000000",
                                hover_color: "0066FF",
                                favicon: true
                            });
                        });
                        t = d.getElementsByTagName('head')[0];
                        s = d.createElement("script");
                        s.type = "text/javascript";
                        s.src = "http://an.yandex.ru/system/context.js";
                        s.setAttribute("async", "true");
                        t.insertBefore(s, t.firstChild);
                    })(window, document, "yandex_context_callbacks");
                </script>
            </div>
        <?php endif; ?>

        <?php if ($data->contestWork !== null): ?>
            <?php $randomParticipants = $data->contestWork->getOtherParticipants(2); if ($randomParticipants): ?>
            <div class="article-contest-conversion">
                <div class="article-contest-conversion_t">
                    Другие участники конкурса
                </div>
                <div class="article-contest-conversion_hold">
                    <?php foreach ($randomParticipants as $contestWork): ?>
                    <?php $this->renderPartial('application.modules.blog.views.default._b_article', array('model' => $contestWork->content, 'showLikes' => false)); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="b-contest-advert">
                <div class="b-contest-advert_ico">
                    <img src="/images/contest/club/pets1/medium.png" alt="" class="b-contest-advert_img">
                </div>
                <div class="b-contest-advert_hold">
                    <div class="b-contest-advert_t">КОНКУРС</div>
                    <div class="b-contest-advert_name"><?=$data->contestWork->contest->title?></div>
                    <a href="<?=$data->contestWork->contest->getParticipateUrl()?>" class="btn-green btn-h46 fancy">Принять участие!</a>
                </div>
            </div>
        <?php endif; ?>

        <?php $this->widget('application.widgets.newCommentWidget.NewCommentWidget', array('model' => $data, 'full' => $full)); ?>
        <!-- /ko -->
    </div>

</div>
<?php $this->widget('application.widgets.seo.SeoLinksWidget'); ?>

<?php if ($full): ?>
<script type="text/javascript">
    $(function() {
        likeControlFixed('.js-like-control', '.comments-gray', 20);
    });
</script>
<?php endif; ?>

<?php if ($ad = $data->isAd()): ?>
<?=$ad['pix']?>
<?php endif; ?>