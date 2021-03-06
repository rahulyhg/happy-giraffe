<?php
/**
 * @var CommunityContest $contest
 * @var bool $takePart
 */


Yii::app()->clientScript->registerPackage('ko_community');
Yii::app()->clientScript->registerMetaTag('noindex', 'robots');
?>

<?php $this->renderPartial('_header', compact('contest')); ?>

<div class="content-cols clearfix">
    <div class="col-1">

        <?php if ($contest->contestWorksCount > 0): ?>
            <div class="readers2 margin-t0">
                <div class="clearfix">
                    <div class="heading-small textalign-c margin-b10">Участники <span class="color-gray">(<?=$contest->contestWorksCount?>)</span> </div>
                </div>
                <?php $lastParticipants = $contest->getLastParticipants(12); if ($lastParticipants): ?>
                <ul class="readers2_ul clearfix">
                    <?php foreach ($lastParticipants as $contestWork): ?>
                        <li class="readers2_li clearfix">
                            <?php $this->widget('Avatar', array('user' => $contestWork->content->author, 'size' => Avatar::SIZE_MICRO)); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if ($contest->status == CommunityContest::STATUS_ACTIVE): ?>
                    <a class="btn-green btn-medium readers2_btn-inline fancy" href="<?=$contest->getParticipateUrl()?>">Принять участие!</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="contest-aside-prizes">
            <div class="contest-aside-prizes_t">Призы конкурса</div>
            <?php $this->renderPartial('_prizes/' . $contest->id); ?>
        </div>

        <?php if ($contest->status != CommunityContest::STATUS_WINNERS_ANNOUNCED && ($topParticipants = $contest->getTopParticipants(3))): ?>
        <div class="fast-articles2 js-fast-articles2">
            <div class="fast-articles2_t-ico"></div>
            <div class="fast-articles2_t">Тройка лидеров</div>
            <?php foreach ($topParticipants as $contestWork): ?>
                <?php $this->renderPartial('application.modules.blog.views.default._popular_one', array('b' => $contestWork->content)); ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="col-23-middle ">
        <?php if ($contest->status == CommunityContest::STATUS_WINNERS_ANNOUNCED && $contest->winners): ?>
            <div class="contest-win">
                <div class="col-gray col-gray__contest">
                    <div class="contest-win_t">Победители конкурса</div>
                    <div class="contest-win_hold">
                        <?php foreach ($contest->winners as $winner): ?>
                        <div class="contest-win_col">

                            <div class="contest-win_place contest-win_place__<?=$winner->place?>"></div>
                            <div class="fast-articles2 ">
                                <?php $this->renderPartial('application.modules.blog.views.default._popular_one', array('b' => $winner->work->content)); ?>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($works->totalItemCount > 0): ?>
            <div class="col-gray col-gray__contest">
                <div class="clearfix">
                    <div class="float-r margin-t10 margin-r20">
                        <div class="chzn-itx-simple chzn-itx-simple__small">
                            <?=CHtml::dropDownList('sort', $sort, array(
                                '0' => 'По дате добавления',
                                '1' => 'По количеству голосов',
                            ), array(
                                'class' => 'chzn',
                                'onchange' => 'document.location.href = \'' . $contest->getUrl() . '?sort=\' + $(this).val();',
                            ))?>
                        </div>

                    </div>
                </div>


                <?php $this->widget('zii.widgets.CListView', array(
                    'cssFile' => false,
                    'ajaxUpdate' => false,
                    'dataProvider' => $works,
                    'itemView' => 'view',
                    'pager' => array(
                        'class' => 'HLinkPager',
                    ),
                    'template' => '{items}
                        <div class="yiipagination">
                            {pager}
                        </div>
                    ',
                    'emptyText' => '',
                    'viewData' => array('full' => false),
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="display-n">
<?php $this->renderPartial('_rules', compact('contest')); ?>
<?php $this->renderPartial('_prizes_popup/' . $contest->id, compact('contest')); ?>
</div>

<?php if ($takePart !== null): ?>
<script type="text/javascript">
    $(function() {
        $('#takePartButton').click();
    });
</script>
<?php endif; ?>