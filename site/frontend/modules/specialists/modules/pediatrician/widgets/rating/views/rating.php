<?php
/**
 * @var \site\frontend\modules\specialists\modules\pediatrician\widgets\rating\RatingWidget $this
 * @var \site\frontend\modules\som\modules\qa\models\QaRating[] $top
 * @var \site\frontend\modules\som\modules\qa\models\QaRating[] $others
 * @var string|null $nextUrl
 */
$topColors = ['yellow', 'blue', 'green'];
$flowersCount = function($votesCount) {
    $votesToFlowers = [
        500 => 5,
        100 => 3,
        9 => 1,
    ];
    foreach ($votesToFlowers as $votesThreshold => $flowers) {
        if ($votesCount > $votesThreshold) {
            return $flowers;
        }
    }
    return 0;
}
?>

<div id="specialistsRating">
    <div class="textalign-c margin-b45">
        <?php foreach ($top as $i => $rating): ?>
        <div class="pediator-rating__item">
            <?php $this->widget('Avatar', [
                'user' => $rating->user,
                'size' => Avatar::SIZE_LARGE,
                'largeAdvanced' => false,
            ]); ?>
            <a href="<?=$rating->user->getUrl()?>" class="font__color--blue display-ib margin-t5"><?=$rating->user->getFullName()?></a><span class="display-ib font__color--crimson margin-b3"><?=$rating->user->specialistInfoObject->title?></span>
            <p class="color-brown-dark margin-b5">
                <span class="margin-r10 display-ib verticalalign-m">Ответы <?=$rating->answers_count?></span>
                <?php if ($rating->votes_count > 0): ?>
                    <?php for ($i = 0; $i < $flowersCount($rating->votes_count); $i++): ?>
                    <span class="pediator-ico--roze pediator-ico--size-s margin-r2 verticalalign-m"></span>
                    <?php endfor; ?>
                    <span class="margin-r10 display-ib verticalalign-m"><?=$rating->votes_count?></span>
                <?php endif; ?>
            </p>
            <div class="font-xl"><?=$rating->total_count?></div>
            <div class="font-n margin-b10"><?=Str::GenerateNoun(['балл', 'балла', 'баллов'], $rating->total_count)?></div>
            <div class="pediator-rating__place pediator-rating__place--<?=$topColors[$i]?>"></div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="clearfix margin-b30">
        <div class="b-raiting clearfix">
            <?php foreach ($others as $i => $rating): ?>
            <div class="b-raiting__left float-l">
                <div class="b-raiting-wrapper clearfix">
                    <div class="b-raiting__item float-l">
                        <div class="b-raiting__num b-raiting__num--grey margin-r15 w-35 font-lm"><?=($i + $this::TOP_COUNT + 1)?></div>
                        <a href="<?=$rating->user->getUrl()?>" class="contest-commentator-rating_user-a">
                            <?php $this->widget('Avatar', [
                                'user' => $rating->user,
                                'size' => Avatar::SIZE_MEDIUM,
                                'tag' => 'span',
                            ]); ?>
                        </a>
                        <div class="contest-footer__ball textalign-l">
                            <a href="<?=$rating->user->getUrl()?>" class="font__color--blue display-b"><?=$rating->user->getFullName()?></a>
                            <span class="display-b font__color--crimson margin-b3"><?=$rating->user->specialistInfoObject->title?></span>
                            <p class="color-brown-dark margin-b5">
                                <span class="margin-r10 display-ib verticalalign-m">Ответы <?=$rating->answers_count?></span>
                                <?php if ($rating->votes_count > 0): ?>
                                    <?php for ($i = 0; $i < $flowersCount($rating->votes_count); $i++): ?>
                                        <span class="pediator-ico--roze pediator-ico--size-s margin-r2 verticalalign-m"></span>
                                    <?php endfor; ?>
                                    <span class="margin-r10 display-ib verticalalign-m"><?=$rating->votes_count?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="b-raiting__item float-r">
                        <div class="contest-footer__ball margin-t10 color-gray-darken">
                            <div class="contest-footer__ball-num"><?=$rating->total_count?></div>
                            <div class="contest-footer__ball-text"><?=Str::GenerateNoun(['балл', 'балла', 'баллов'], $rating->total_count)?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if ($nextUrl): ?>
        <div class="textalign-c"><span class="btn btn-ml green-btn" onclick="$('#specialistsRating').load('<?=$nextUrl?> #specialistsRating');">Показать еще</span></div>
    <?php endif; ?>
</div>
