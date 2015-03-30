<?php
/**
 * @var \site\frontend\modules\consultation\models\ConsultationQuestion $data
 */


?>

<div class="b-consult-qa-ms">
    <div class="b-consult-qa-ms__question comments_li__lilac">
        <div class="b-consult-qa-ms__img"><img src="<?=$data->user->avatarUrl?>" alt=""></div>
        <div class="b-consult-qa-mst"><a href="<?=$data->user->profileUrl?>" class="b-consult-qa-ms__name"><?=$data->user->fullName?></a>
            <?=HHtml::timeTag($data, array('class' => 'tx-date'), null) ?>
            <div class="b-consult-qa-ms__message comments_cont">
                <div class="b-consult-qa-ms__message__title"><?=$data->title?></div>
                <div class="b-consult-qa-ms__message__text"><?=\site\common\helpers\HStr::truncate($data->text, 500)?></div>
            </div>
        </div>
    </div>
    <?php if ($data->answer): ?>
    <div class="b-consult-qa-ms__answer comments_li__red">
        <div class="b-consult-qa-ms__img"><img src="<?=$data->answer->user->avatarUrl?>" alt=""></div>
        <div class="b-consult-qa-mst"><a href="<?=$data->answer->user->profileUrl?>" class="b-consult-qa-ms__name"><?=$data->answer->user->fullName?></a>
            <?=HHtml::timeTag($data->answer, array('class' => 'tx-date'), null) ?>
            <div class="b-consult-qa-ms__message comments_cont">
                <div class="b-consult-qa-ms__message__text"><?=\site\common\helpers\HStr::truncate($data->answer->text, 500)?></div><a href="<?=$data->answer->getUrl()?>">Читать весь ответ</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($data->answer === null && Yii::app()->user->checkAccess('answerQuestions', array('consultation' => $this->consultation))): ?>
        <a href="<?=$this->createUrl('answer', array('slug' => $this->consultation->slug, 'questionId' => $data->id))?>">Ответить</a>
    <?php endif; ?>
</div>