<?php $this->beginContent('//layouts/main');?>

<div class="clearfix">
    <div class="default-nav">

        <?php
        $this->widget('zii.widgets.CMenu', array(
            'itemTemplate' => '{menu}<span class="tale"><img src="/images/default_nav_active.gif"></span>',
            'items' => array(
                array(
                    'label' => 'Статистика',
                    'url' => array('/commentators/default/index'),
                ),
            )));

        ?>
    </div>

    <?php $this->renderPartial('//layouts/_header'); ?>

    <div class="fast-nav">
        <ul>
            <li<?php if (!isset($_GET['user_id'])) echo ' class="active"' ?>><a href="<?=$this->createUrl('/statistic/stat/moderators/')?>">Все модераторы</a></li>
            <?php $commentators = Yii::app()->user->getState('commentators') ?>
            <?php if (is_array($commentators)):?>
            <?php foreach ($commentators as $commentator): ?>
                <li<?php if (isset($_GET['user_id']) && $_GET['user_id'] == $commentator) echo ' class="active"' ?>><a href="<?=$this->createUrl('/statistic/stat/moderators/', array('user_id'=>$commentator))?>"><?=User::getUserById($commentator)->fullName ?></a><a href="javascript:;" class="remove" onclick="SeoModule.removeUser('commentators', <?=$commentator ?>, this)"></a></li>
                <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>

</div>
<?php echo $content; ?>

<?php $this->endContent(); ?>