<?php
    Yii::app()->clientScript->registerMetaTag($data->meta_description, 'description');
    Yii::app()->clientScript->registerMetaTag($data->meta_keywords, 'keywords');
?>

<?php $this->renderPartial('_post', array('data' => $data, 'full' => true)); ?>

<div class="content-more clearfix">
    <big class="title">
        Ещё статьи на эту тему
        <a href="<?php echo CHtml::normalizeUrl($this->getUrl(array('content_type_slug' => null))); ?>" class="btn btn-blue-small"><span><span>Показать все</span></span></a>
    </big>
    <?php
        foreach ($data->relatedPosts as $rc)
        {
            $content = '';
            switch ($rc->type->slug)
            {
                case 'post':
                    if (preg_match('/src="([^"]+)"/', $rc->post->text, $matches)) {
                        $content = '<img src="' . $matches[1] . '" alt="' . $rc->name . '" width="150" />';
                    }
                    else
                    {
                        if (preg_match('/<p>(.+)<\/p>/Uis', $rc->post->text, $matches2)) {
                            $content = strip_tags($matches2[1]);
                        }
                    }
                    break;
                case 'travel':
                    if (preg_match('/src="([^"]+)"/', $rc->travel->text, $matches)) {
                        $content = '<img src="' . $matches[1] . '" alt="' . $rc->name . '" width="150" />';
                    }
                    else
                    {
                        if (preg_match('/<p>(.+)<\/p>/Uis', $rc->travel->text, $matches2)) {
                            $content = strip_tags($matches2[1]);
                        }
                    }
                    break;
                case 'video':
                    $video = new Video($rc->video->link);
                    $content = '<img src="' . $video->preview . '" alt="' . $video->title . '" />';
                    break;
            }
        ?>
            <div class="block">
                <b><?php echo CHtml::link($rc->name, $this->createUrl('community/view', array('community_id' => $c->rubric->community->id, 'content_type_slug' => $rc->type->slug, 'content_id' => $rc->id))); ?></b>
                <p><?php echo $content; ?></p>
            </div>
        <?php
        }
    ?>
</div>

<?php $this->widget('application.widgets.commentWidget.CommentWidget', array(
    'model' => $data,
)); ?>

<?php
$remove_tmpl = $this->beginWidget('site.frontend.widgets.removeWidget.RemoveWidget');
$remove_tmpl->registerTemplates();
$this->endWidget();
?>