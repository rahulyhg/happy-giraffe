<?php

use site\frontend\modules\som\modules\qa\models\qaTag\Enum;

/**
 * @var \site\frontend\modules\som\modules\qa\models\QaQuestion $data
 */
?>

<li class="b-answer__item">
    <div class="b-answer__header b-answer-header"><span class="b-answer-header__link"><?=$data->user->getAnonName()?></span>
        <!-- <time class="b-answer-header__time">5 минут назад</time> -->
        <?= HHtml::timeTag($data, array('class' => 'b-answer-header__time')); ?>
    </div>
    <div class="b-answer__container">
        <div class="b-answer__left">
            <div class="b-answer__body b-answer-body">
            	<a href="<?=$data->url?>" class="b-answer-body__link b-title--h7 b-text--link-color b-title--bold"><?=strip_tags($data->title)?></a>
                <p class="b-answer-body__text"><?=strip_tags($data->text)?></p>
            </div>
            <?php if (!is_null($data->tag)): ?>
                <div class="b-answer__footer b-answer-footer">
                	<a href="<?=$this->createUrl('/som/qa/default/pediatrician', ['tab' => 'new', 'tagId' => $data->tag->id])?>" class="b-answer-footer__age b-text--link-color"><?=(new Enum())->getTitleForWeb($data->tag->name)?></a>
                </div>
  			<?php endif; ?>
        </div>
        <div class="b-answer__right">
        	<a href="<?=$data->url?>" class="b-answer-footer__box b-answer-footer__box--blue">
        		<span class="b-answer-footer__num"><?=$data->answersCount?></span>
        		<span class="b-answer-footer__text b-answer-footer__text--grey">ответа</span>
    		</a>
        </div>
    </div>
</li>