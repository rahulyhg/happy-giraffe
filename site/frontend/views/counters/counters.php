<script type="text/javascript" src="//wurfl.io/wurfl.js"></script>
<script type="text/javascript">
    isAmd = <?=CJavaScript::encode(Yii::app()->clientScript->useAMD)?>;
    isGuest = <?=CJavaScript::encode(Yii::app()->user->isGuest)?>;
    dataLayer = [{

    }];
</script>

<?php Yii::app()->controller->renderPartial('//counters/_google_tag'); ?>
<?php Yii::app()->controller->renderPartial('//counters/_metrika'); ?>
<?php //Yii::app()->controller->renderPartial('//counters/_ga'); ?>
<?php //Yii::app()->controller->renderPartial('//counters/_top100'); ?>