<?php
/**
 * @var CommunityContest $contest
 */
?>

<div class="b-section b-section__contest">
    <div class="b-section_hold">
        <div class="content-cols clearfix">
            <div class="col-1">
                <div class="textalign-c">
                    <img src="/images/contest/club/pets1/big.png" alt="">
                </div>
            </div>
            <div class="col-23-middle">
                <div class="b-section_contest">
                    <div class="b-section_t-contest clearfix">
                        <span class="b-section_t-contest-small">Конкурс</span>
                        <?=$contest->title?>
                    </div>
                    <div class="b-section_contest-tx clearfix">
                        <p><?=$contest->description?></p>
                    </div>
                    <div class="clearfix">
                        <a href="#popup-contest-rule" class="b-section_contest-rule fancy">Правила конкурса</a>
                        <a href="<?=$contest->getParticipateUrl()?>" class="float-r btn-green btn-h46 fancy">Принять участие!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>