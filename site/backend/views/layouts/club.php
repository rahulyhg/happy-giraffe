<?php $this->beginContent('//layouts/main'); ?>
<!-- .header -->
<div class="navigation">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'linkLabelWrapper' => 'span',
        'items' => array(
            array(
                'label' => 'Главная',
                'url' => array('modules/index'),
            ),
            array('label' => 'Имена',
                'url' => array('/club/names/index'),
                'active' => (Yii::app()->controller->id == 'club/names'),
                'visible' => Yii::app()->user->checkAccess('names')
            ),
            array('label' => 'Жалобы',
                'active' => (Yii::app()->controller->id == 'club/reports' && Yii::app()->controller->action->id == 'index'),
                'url' => array('/club/reports/index'),
                'visible' => Yii::app()->user->checkAccess('report')
            ),
            array('label' => 'Спам',
                'active' => (Yii::app()->controller->id == 'club/reports' && Yii::app()->controller->action->id == 'spam'),
                'url' => array('/club/reports/spam'),
                'visible' => Yii::app()->user->checkAccess('report')
            ),
            array('label' => 'Интересы',
                'active' => (in_array(Yii::app()->controller->id, array('club/interest', 'club/interestCategory'))),
                'url' => array('/club/interest/'),
                'visible' => Yii::app()->user->checkAccess('interests'),
                'items' => array(
                    array(
                        'label' => 'Категории',
                        'url' => array('/club/interestCategory/'),
                    ),
                )
            ),
            array('label' => 'Гороскоп',
                'active' => (Yii::app()->controller->id == 'club/horoscope'),
                'url' => array('/club/horoscope/'),
                'visible' => Yii::app()->user->checkAccess('horoscope')
            ),
        ),
    ));?>
    <div class="clear"></div>
    <!-- .clear -->
</div>
<!-- .navigation -->
<div class="content">
    <?php echo $content; ?>
</div>
<!-- .content -->
<?php $this->endContent(); ?>