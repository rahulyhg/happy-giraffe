<?php
/**
 * User: Eugene
 * Date: 06.06.12
 */
class photoViewWidget extends CWidget
{
    public $selector;
    public $entity;
    public $entity_id;
    public $singlePhoto = false;

    public function init()
    {
        $this->widget('site.frontend.widgets.socialLike.SocialLikeWidget', array(
            'registerScripts' => true,
        ));
        $this->widget('site.frontend.widgets.commentWidget.CommentWidget', array(
            'registerScripts' => true,
        ));
        $remove_tmpl = $this->beginWidget('site.frontend.widgets.removeWidget.RemoveWidget');
        $remove_tmpl->registerTemplates();
        $this->endWidget();

        Yii::app()->clientScript->registerScript('pGallery',
            '$("' . $this->selector . '").pGallery(' . CJavaScript::encode(array('singlePhoto' => $this->singlePhoto, 'entity' => $this->entity, 'entity_id' => (is_int($this->entity_id)) ? $this->entity_id : 'null')) . ');'
        );

        Yii::app()->clientScript->registerScriptFile('/javascripts/history.js');
        Yii::app()->clientScript->registerScriptFile('/javascripts/gallery.js?r=' . time());

        $report = $this->beginWidget('site.frontend.widgets.reportWidget.ReportWidget');
        $report->registerScripts();
        $this->endWidget();
    }
}
