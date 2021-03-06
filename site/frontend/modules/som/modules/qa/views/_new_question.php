<?php

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
            <a class="b-block" href="<?=$data->url?>">
                <div class="b-answer__body b-answer-body">
                    <span class="b-answer-body__link b-title--h7 b-text--link-color b-title--bold"><?=strip_tags($data->title)?></span>
                    <p class="b-answer-body__text"><?=strip_tags($data->text)?></p>
                </div>
            </a>
            <?php if (!is_null($data->tag) && is_null($data->attachedChild)): ?>
                <div class="b-answer__footer b-answer-footer">
					<a href="<?=UrlCreator::create(UrlCreator::create(null)->getPath(), ['filter' => ['tag' => $data->tag->id]])?>" class="b-answer-footer__age b-text--link-color"><i aria-hidden="true" class="icon icon-tag"></i>&nbsp;&nbsp; <?=$data->tag->getTitle()?></a>
                </div>
  			<?php endif; ?>
  			<?php
  			   if (!is_null($data->attachedChild) and !is_null($fmember = $data->attChild)) {
            	   $arrFooterData = $fmember->getAnswerFooterData();
	           ?>
        	   <?php if (!\Yii::app()->user->isGuest && $data->author->id == \Yii::app()->user->id) { ?>
    			<div class="b-answer__footer b-answer-footer">
    				<a href="javascript:void(0);" class="ava-pediator">
						<span class="ava--style ava--small ava--medium_male">
        					<?php if ($arrFooterData['imgUrl'] == '#') {?>
            					<span class="icon-family icon-family--small icon-family--<?=$arrFooterData['css']?>"></span>
        					<?php } else { ?>
        						<img src="<?=$arrFooterData['imgUrl']?>" class="ava__img-box">
        					<?php } ?>
    					</span>
    					<span class="ava-pediator__sub"><?=$arrFooterData['childName']?></span>
    				</a>
    			</div>
    		   <?php } elseif (!is_null($arrFooterData['tag'])) { ?>
    			<div class="b-answer__footer b-answer-footer">
					<a href="<?=UrlCreator::create(UrlCreator::create(null)->getPath(), ['filter' => ['tag' => $data->tag->id]])?>" class="b-answer-footer__age b-text--link-color"><i aria-hidden="true" class="icon icon-tag"></i>&nbsp;&nbsp; <?=$arrFooterData['tag']->getTitle()?></a>
                </div>
    		   <?php }?>
		   <?php }?>
        </div>
        <div class="b-answer__right">
        	<?php if ($data->getAnswersCount() > 0):?>
            	<a href="<?=$data->url?>" class="b-answer-footer__box b-answer-footer__box--blue">
            		<span class="b-answer-footer__num"><?= $data->getAnswersCount(); ?></span>
            		<span class="b-answer-footer__text b-answer-footer__text--grey"><?=\Yii::t('app', 'ответ|ответа|ответов|ответа', $data->getAnswersCount())?></span>
        		</a>
    		<?php else: ?>
            	<a href="<?=$data->url?>" class="b-answer-footer__box b-answer-footer__box--green">
            		<span class="b-answer-footer__text b-answer-footer__text--white">ответить</span>
        		</a>
        	<?php endif; ?>
        </div>
    </div>
</li>
