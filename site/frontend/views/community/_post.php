<?php
/* @var $this CommunityController
 * @var $data CommunityContent
 */

    if (Yii::app()->request->getParam('Comment_page', 1) != 1) {
        Yii::app()->clientScript->registerMetaTag('noindex', 'robots');
    }

    if ($full) {
        if (empty($this->meta_description)){
            if (!empty($data->meta_description))
                $this->meta_description = $data->meta_description;
            else
                $this->meta_description = Str::getDescription($data->getContent()->text);
        }
    }
?>
<div class="entry<?php if ($full): ?> entry-full<?php endif; ?>">

    <?php $this->renderPartial('//community/_post_header', array('model' => $data, 'full' => $full, 'show_user' => ($data->isFromBlog || $data->rubric->community_id != Community::COMMUNITY_NEWS))); ?>

    <?php if (! $full): ?>
        <?php if ($data->type_id == 5): ?>
            <div class="entry-content user-status">
                <?=CHtml::link(strip_tags($data->status->status->text), $data->url)?>
            </div>
        <?php else: ?>
            <div class="entry-content wysiwyg-content">
                <?php
                    switch ($data->type->slug)
                    {
                        case 'video':
                            echo $data->purified->preview . '<div style="text-align: center; margin-bottom: 10px;">' . $data->video->getEmbed() . '</div>';
                            break;
                        default:
                            echo $data->purified->preview;
                    }
                ?>
                <?php if ($data->type_id != 5 && ($data->isFromBlog || $data->rubric->community_id == Community::COMMUNITY_NEWS)): ?>
                    <?=CHtml::link('Читать всю запись<i class="icon"></i>', $data->url, array('class' => 'read-more'))?>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if ($data->type_id == 5): ?>
            <div class="entry-content user-status">
                <?=$data->status->status->purified->text?>
            </div>
        <?php else: ?>
            <div class="entry-content">
                <div class="wysiwyg-content">
                    <?
                    switch ($data->type->slug)
                    {
                        case 'status':
                            echo $data->status->status->purified->text;
                            break;
                        case 'post':
                            $text = $data->post->purified->text;
                            if ($data->gallery !== null && count($data->gallery->items) > 0) {
                                $gallery = Yii::app()->controller->renderPartial('/community/_gallery', array('data' => $data), true);
                                if (strpos($text, '<!--gallery-->') === false) {
                                    $text = $text . $gallery;
                                } else {
                                    $text = str_replace('<!--gallery-->', $gallery, $text);
                                }
                            }
                            echo $text;
                            break;
                        case 'video':
                            echo '<noindex><div style="text-align: center; margin-bottom: 10px;">' . $data->video->getEmbed() . '</div></noindex>';
                            echo $data->video->purified->text;
                            break;
                    }
                    ?>

                    <div class="clear"></div>
                </div>

                <?php if($data->gallery !== null && count($data->gallery->items) > 0): ?>
                    <?php $photo = $data->gallery->items[0]; ?>
                    <?php
                    $this->widget('site.frontend.widgets.photoView.photoViewWidget', array(
                        'selector' => '.gallery-box a',
                        'entity' => get_class($data->gallery),
                        'entity_id' => (int)$data->gallery->primaryKey,
                    ));
                    if ((isset($_GET['utm_source']) && $_GET['utm_source'] == 'email') || (isset($_GET['open_gallery']) && $_GET['open_gallery'] == 1)) {
                        Yii::app()->clientScript->registerScript('open_pGallery','setTimeout(function(){$(".gallery-box a.img").trigger("click")},400);', CClientScript::POS_READY);
                    }

                ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($data->type_id != 5): ?>
        <div class="entry-footer">
            <?php if(!Yii::app()->user->isGuest && $full){
                $report = $this->beginWidget('site.frontend.widgets.reportWidget.ReportWidget', array('model' => $data));
                $report->button("$('.report-container')");
                $this->endWidget();
            }

            $this->renderPartial('//community/admin_actions',array(
                'c'=>$data,
            ));

            $this->renderPartial('//community/parts/move_post_popup',array('c'=>$data));

            if (isset($this->community) && ! $data->isFromBlog && $this->community->id == 22 && Yii::app()->authManager->checkAccess('importCookRecipes', Yii::app()->user->id))
                echo CHtml::link('Перенести в рецепты', array('/cook/recipe/import', 'content_id' => $data->id));

            ?>

            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <div class="report-container"></div>
</div>

<?php if ($full): ?>
    <?php
        switch ($data->type->slug) {
            case 'status':
                $like_title = 'Вам понравился статус? Отметьте!';
                $like_notice = '<big>Рейтинг статуса</big><p>Он показывает, насколько нравится ваш статус другим пользователям. Если статус интересный, то пользователи его читают, комментируют, увеличивают лайки социальных сетей.</p>';
            case 'post':
                $like_title = 'Вам понравилась статья? Отметьте!';
                $like_notice = '<big>Рейтинг статьи</big><p>Он показывает, насколько нравится ваша статья другим пользователям. Если статья интересная, то пользователи её читают, комментируют, увеличивают лайки социальных сетей.</p>';
                break;
            case 'video':
                $like_title = 'Вам полезно видео? Отметьте!';
                $like_notice = '<big>Рейтинг видео</big><p>Он показывает, насколько нравится ваше видео другим пользователям. Если видео интересное, то пользователи его смотрят, комментируют, увеличивают лайки социальных сетей.</p>';
                break;
        }
    ?>
    <noindex>
        <?php $this->widget('site.frontend.widgets.socialLike.SocialLikeWidget', array(
            'title' => $like_title,
            'notice' => $like_notice,
            'model' => $data,
            'type' => 'simple',
            'options' => array(
                'title' => $data->title,
                'image' => $data->getContentImage(400),
                'description' => $data->getContent()->text,
            ),
        )); ?>
    </noindex>
<?php endif; ?>