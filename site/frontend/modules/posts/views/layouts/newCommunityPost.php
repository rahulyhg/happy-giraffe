<?php
$this->bodyClass .= ' page-community';
$this->beginContent('//layouts/lite/community');
?>
<div class="b-main_cont">
    <div class="b-main_col-hold clearfix">
        <?php
        echo $content;
        ?>
        <aside class="b-main_col-sidebar visible-md">
            <?php $this->beginWidget('AdsWidget', array('dummyTag' => 'adfox')); ?>
            <div class="bnr-base">
                <!--AdFox START-->
                <!--giraffe-->
                <!--Площадка: Весёлый Жираф / * / *-->
                <!--Тип баннера: Безразмерный 240x400-->
                <!--Расположение: &lt;сайдбар&gt;-->
                <!-- ________________________AdFox Asynchronous code START__________________________ -->
                <script type="text/javascript">
                    <!--
                    if (typeof (pr) == 'undefined') {
                        var pr = Math.floor(Math.random() * 1000000);
                    }
                    if (typeof (document.referrer) != 'undefined') {
                        if (typeof (afReferrer) == 'undefined') {
                            afReferrer = escape(document.referrer);
                        }
                    } else {
                        afReferrer = '';
                    }
                    var addate = new Date();


                    var dl = escape(document.location);
                    var pr1 = Math.floor(Math.random() * 1000000);

                    document.write('<div id="AdFox_banner_' + pr1 + '"><\/div>');
                    document.write('<div style="visibility:hidden; position:absolute;"><iframe id="AdFox_iframe_' + pr1 + '" width=1 height=1 marginwidth=0 marginheight=0 scrolling=no frameborder=0><\/iframe><\/div>');

                    AdFox_getCodeScript(1, pr1, 'http://ads.adfox.ru/211012/prepareCode?pp=dey&amp;ps=bkqy&amp;p2=etcx&amp;pct=a&amp;plp=a&amp;pli=a&amp;pop=a&amp;pr=' + pr + '&amp;pt=b&amp;pd=' + addate.getDate() + '&amp;pw=' + addate.getDay() + '&amp;pv=' + addate.getHours() + '&amp;prr=' + afReferrer + '&amp;dl=' + dl + '&amp;pr1=' + pr1);
                    // -->
                </script>
                <!-- _________________________AdFox Asynchronous code END___________________________ -->
            </div>
            <?php $this->endWidget(); ?>

			<?php if($this->forum) { ?>
                <community-add params="forumId: <?= $this->forum->id ?>, clubSubscription: <?= CJSON::encode(UserClubSubscription::subscribed(Yii::app()->user->id, $this->club->id)) ?>, clubId: <?= $this->club->id ?>, subsCount: <?= (int)UserClubSubscription::model()->getSubscribersCount($this->club->id) ?>"></community-add>
            <?php } ?>

            <div class="side-block">
                <div class="side-block_tx">Рубрики клуба</div>
                <ul class="rubrics">
                    <?php foreach ($this->forum->rubrics as $rubric): ?>
                        <?php if ($rubric->parent_id === null): ?>
                            <li class="rubrics_li"><a class="rubrics_a" href="<?=$rubric->getUrl()?>"><?=$rubric->title?></a>
                                <div class="rubrics_count"><span class="rubrics_count_tx"><?=\site\frontend\modules\community\helpers\StatsHelper::getRubricCount($rubric->id)?></span></div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>
</div>

    <?php if (Yii::app()->vm->getVersion() == VersionManager::VERSION_DESKTOP): ?>
    <div class="homepage">
        <div class="homepage_row">
            <div class="homepage-posts">
                <div class="homepage_title">еще рекомендуем</div>
                <div class="homepage-posts_col-hold">

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php
$this->endContent();
