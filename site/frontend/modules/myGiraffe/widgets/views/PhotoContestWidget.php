<?php
/**
 * @var Contest $contest
 * @var ContestWork[] $participants
 */
?>

<div class="b-article-conversion b-article-conversion__contest b-article-conversion__12">
    <div class="b-article-conversion_hold clearfix">
        <a href="javascript:void(0)" class="a-pseudo b-article-conversion_hide" onclick="$(this).parents('.b-article-conversion__12').hide();">Скрыть</a>
        <div class="b-article-conversion_tx-top">Внимание! С 14 ноября стартовал</div>
        <div class="textalign-c">
            <img src="/images/contest/b-article-conversion__12-heading-title.png" alt="">
        </div>
        <div class="textalign-c font-middle">
            <a href="">Участники конкурса (<?=$contest->worksCount?>)</a>
        </div>
        <div class="textalign-c">
            <?php foreach ($participants as $p): ?>
            <div class="fast-articles2 ">
                <div class="fast-articles2_i">
                    <div class="fast-articles2_header clearfix">
                        <span class="ico-status ico-status__<?=((bool) $p->author->online ? 'online' : 'offline')?>"></span>
                        <a class="ava-name" href="<?=$p->author->getUrl()?>"><?=$p->author->first_name?></a>
                    </div>
                    <div class="fast-articles2_i-t">
                        <a class="fast-articles2_i-t-a" href="<?=$p->getUrl()?>"><?=$p->title?></a>
                        <span class="fast-articles2_i-t-count"><?=$p->rate?></span>
                    </div>
                    <div class="fast-articles2_i-img-hold">
                        <a href="<?=$p->getUrl()?>"><?=CHtml::image($p->photoAttach->photo->getPreviewUrl(220, null, Image::WIDTH), $p->title)?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="clearfix">
            <a href="http://www.silver-care.ru/" class="b-article-conversion_sponsor-logo"></a>
            <div class="b-article-conversion_tx-bottom">Покажите нам ваши улыбки!  </div>
            <div class="textalign-c margin-b20">
                <a href="<?=$contest->getUrl()?>" class="btn-green btn-h46">Принять участие!</a>
            </div>
        </div>
    </div>
</div>