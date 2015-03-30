<?php
/**
 * @var \LiteController $this
 * @var \site\frontend\modules\consultation\models\ConsultationQuestion $question
 */

$this->pageTitle = $question->title;
?>

<div class="b-main_col-article">
    <!-- Статья с текстом-->
    <!-- b-article-->
    <article class="b-article b-article__single clearfix b-article__lite">
        <div class="b-article_cont clearfix">
            <div class="b-article_header clearfix">
                <div class="float-l">
                    <a href="<?=$question->user->profileUrl ?>" class="ava ava__female ava__small-xxs ava__middle-xs ava__middle-sm-mid "><span class="ico-status ico-status__online"></span><img alt="<?=$question->user->fullName ?>" src="<?=$question->user->avatarUrl ?>" class="ava_img"></a><a href="<?=$question->user->profileUrl ?>" class="b-article_author"><?=$question->user->fullName?></a>
                    <?=HHtml::timeTag($question, array('class' => 'tx-date'), null) ?>
                </div>
                <div class="icons-meta">
                    <div class="icons-meta_view"><span class="icons-meta_tx"><?=Yii::app()->getModule('analytics')->visitsManager->getVisits()?></span></div>
                </div>
            </div>
            <h1 class="b-article_t"><?=$question->title?></h1>
            <div class="b-article_in clearfix">
                <div class="wysiwyg-content clearfix">
                    <?=$question->text?>
                </div>
            </div>
        </div>
        <?php if ($question->answer === null && Yii::app()->user->checkAccess('manageOwnContent', array('entity' => $question))): ?>
            <a href="<?=$this->createUrl('create', array('slug' => $this->consultation->slug, 'questionId' => $question->id))?>">Редактировать</a>
        <?php endif; ?>
    </article>
    <!-- Статья с текстом-->
    <!-- b-article-->
    <?php if ($question->answer): ?>
    <article class="b-article b-article__single clearfix b-article__lite" id="answer">
        <div class="b-consult-open">
            <div class="b-consult-open__answer">Ответ:</div>
            <div class="b-article_cont clearfix">
                <div class="b-article_header clearfix">
                    <?php if (! $this->isConsultant()): ?>
                        <a href="<?=$this->createUrl('create', array('slug' => $this->consultation->slug))?>" class="b-consult-button small right login-button" data-bind="follow:{}">Задать вопрос</a>
                    <?php endif; ?>
                    <div class="float-l">
                        <a href="<?=$question->answer->user->profileUrl ?>" class="ava ava__female ava__small-xxs ava__middle-xs ava__middle-sm-mid "><span class="ico-status ico-status__online"></span><img alt="<?=$question->answer->user->fullName ?>" src="<?=$question->answer->user->avatarUrl ?>" class="ava_img"></a><a href="<?=$question->answer->user->profileUrl ?>" class="b-article_author"><?=$question->answer->user->fullName?></a>
                        <?=HHtml::timeTag($question->answer, array('class' => 'tx-date'), null) ?>
                    </div>
                </div>
                <div class="b-article_in clearfix">
                    <div class="wysiwyg-content clearfix">
                        <?=$question->answer->text?>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php endif; ?>
    <?php if ($this->isConsultant()): ?>
        <a href="<?=$this->createUrl('answer', array('slug' => $this->consultation->slug, 'questionId' => $question->id))?>"><?=($question->answer === null) ? 'Ответить' : 'Редактировать ответ' ?></a>
    <?php endif; ?>
</div>
<div class="b-main_col-sidebar visible-md">
    <?php $this->renderPartial('_specialist'); ?>
    <?php
        $this->widget('site\frontend\modules\consultation\widgets\OtherQuestionsWidget', array(
            'question' => $question,
        ));
    ?>
</div>