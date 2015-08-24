<?php
/* @var $this Controller
 * @var $models CommunityContent[]
 */
$i = 0;
\Yii::import('site.frontend.vendor.simplehtmldom_1_5.*');
require_once('simple_html_dom.php');
?>

<table style="width:100%;margin-bottom:50px;" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <?php foreach ($models as $model): ?>
        <?php if ($i == 1): ?>
            <td style="width:340px;padding-left:20px;" valign="top">

                <div style="padding:10px;border:1px solid #e7e7e7;width:318px;">

                    <table cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
                        <tbody>
                        <tr>
                            <td valign="middle"><img src="http://img.happy-giraffe.ru/v2/crops/avatarMedium/21/8e/a1414d1c8af5b4531e74131270fd.jpg"
                                                     style="display:block;margin-top:-40px;-moz-border-radius:36px;-webkit-border-radius:36px;border-radius:36px;">
                            </td>
                            <td valign="top">
                                <span style="color:#38a5f4;font:12px arial, helvetica, sans-serif;margin-left:10px;">Константин Елезаренко</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div style="margin-bottom:10px;">
                <span style="color:#0d81d5;font:bold 18px/20px arial, helvetica, sans-serif;">
                    <a href="http://www.happy-giraffe.ru/community/26/forum/advpost/691084/" target="_blank" style="color:#0d81d5;font:bold 18px/20px arial, helvetica, sans-serif;">Friendbe Workshop - смешной проект, созданный из отчаяния и зависти</a></span>
                    </div>

                    <div style="margin-bottom:5px;">
                        <a href="http://www.happy-giraffe.ru/community/26/forum/advpost/691084/" target="_blank" style="text-decoration: none;">
                            <img src="http://img.happy-giraffe.ru/v2/thumbs/e26e4ffdce15f4bc6711c767ffa68dac/ce/5b/2561bc879db765360d6891ef2120.jpg" width="318" border="0" style="display:block;"></a>
                    </div>


                    <div style="font:13px/18px arial, helvetica, sans-serif;color:#040404;">
                        Педагоги и психологи постоянно напоминают, что воспитание ребенка, как творческой личности - это "целенаправленный процесс", включающий эстетику обстановки: вещей, которые окружают ребёнка и которыми он пользуется, игрушек, одежды, так же окружающих его людей...
                            <span style="color:#0d81d5;">
                    <a href="http://www.happy-giraffe.ru/community/26/forum/advpost/691084/" target="_blank" style="color:#0d81d5;">Читать&nbsp;всю&nbsp;запись&nbsp;<img
                            src="http://www.happy-giraffe.ru/images/mail/icon_more.gif" style="margin-left:5px;"></a>
                </span>
                    </div>

                    <table cellpadding="0" cellspacing="0" style="margin-top:20px;">
                        <tbody>
                        <tr>

                            <td style="padding-right:15px;">
                        <span style="color:#31a4f6;font:12px arial, helvetica, sans-serif;">
                            <a href="http://www.happy-giraffe.ru/community/26/forum/advpost/691084/#comment_list" target="_blank" style="color:#31a4f6;font:12px arial, helvetica, sans-serif;"><img
                                    src="http://www.happy-giraffe.ru/images/mail/icon_comments.gif"
                                    style="margin-right:5px;vertical-align:top;">49</a></span>
                            </td>
                            <td>
                                <?php $used = array(); $comments = site\frontend\modules\comments\models\Comment::model()->findAllByAttributes(array(
                                    'entity' => 'AdvPost',
                                    'entity_id' => 691084,
                                )); ?>
                                <?php $j = 0; foreach ($comments as $comment): ?>
                                    <?php if (!empty($comment->author->avatar_id) && !in_array($comment->author->avatar_id, $used)):?>
                                        <?php $j++;$used[] = $comment->author->avatar_id ?>
                                        <img src="<?php echo $comment->author->getAvatarUrl(Avatar::SIZE_MICRO) ?>"
                                             style="margin-right:5px;-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;">
                                        <?php if ($j == 5) break; ?>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </td>
        <?php else: ?>
        <?php
            $url = 'http://www.happy-giraffe.ru' . ltrim($model->getUrl(), '.');
            if ($model->type_id == CommunityContent::TYPE_PHOTO_POST) {
                $url .= '#openGallery';
            }
        ?>

            <td style="width:340px;<?php if ($i % 2 != 0) echo "padding-left:20px" ?>" valign="top">

            <div style="padding:10px;border:1px solid #e7e7e7;width:318px;">

                <table cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
                    <tbody>
                    <tr>
                        <td valign="middle"><img src="<?php echo ($ad = $model->isAd()) ? ('http://www.happy-giraffe.ru' . $ad['img']) : $model->author->getAvatarUrl() ?>"
                                                 style="display:block;margin-top:-40px;-moz-border-radius:36px;-webkit-border-radius:36px;border-radius:36px;">
                        </td>
                        <td valign="top">
                            <span style="color:#38a5f4;font:12px arial, helvetica, sans-serif;margin-left:10px;"><?php echo ($ad = $model->isAd()) ? $ad['text'] : $model->author->first_name ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div style="margin-bottom:10px;">
                <span style="color:#0d81d5;font:bold 18px/20px arial, helvetica, sans-serif;">
                    <a href="<?php echo $url; ?>" target="_blank" style="color:#0d81d5;font:bold 18px/20px arial, helvetica, sans-serif;"><?php echo $model->title ?></a></span>
                </div>

                <?php if (false): ?>
                <div style="margin-bottom:5px;">
                    <span style="color:#b6b9ba;font:9px tahoma, arial, helvetica, sans-serif;"><?php echo  Yii::app()->dateFormatter->format("d MMMM yyyy, H:mm", $model->created); ?></span>
                </div>
                <?php endif; ?>

                <?php
                $image_url = $model->getContentImage(580, 1000);

                if ($model->type_id == CommunityContent::TYPE_POST) {
                    $post = \site\frontend\modules\posts\models\Content::model()->byEntity('CommunityContent', $model->id)->find();
                    $docs = array(str_get_html($post->preview), str_get_html($post->html));
                    foreach ($docs as $doc) {
                        $img = $doc->find('img', 0);
                        if ($img !== null) {
                            $src = $img->src;
                            $photo = \Yii::app()->thumbs->getPhotoByUrl($src);
                            if ($photo !== null) {
                                $image_url = Yii::app()->thumbs->getThumb($photo, 'weeklyNews')->getUrl();
                                break;
                            }
                        }
                    }
                }

                if (!empty($image_url))
                    $image_size = getimagesize($image_url);
                else
                    $image_size = array(0);
                if ($image_size[0]>100) {
                ?>
                <div style="margin-bottom:5px;">
                    <a href="<?php echo $url; ?>" target="_blank" style="text-decoration: none;">
                        <img src="<?php echo $image_url ?>" width="318" border="0" style="display:block;"></a>
                </div>
                <?php } ?>

                <div style="font:13px/18px arial, helvetica, sans-serif;color:#040404;">
                    <?php echo  $model->getContentText(450); ?>
                    <span style="color:#0d81d5;">
                    <a href="<?php echo $url; ?>" target="_blank" style="color:#0d81d5;">Читать&nbsp;всю&nbsp;запись&nbsp;<img
                        src="http://www.happy-giraffe.ru/images/mail/icon_more.gif" style="margin-left:5px;"></a>
                </span>
                </div>

                <table cellpadding="0" cellspacing="0" style="margin-top:20px;">
                    <tbody>
                    <tr>
                        <?php if (false): ?>
                        <td style="padding-right:10px;">
                        <span style="color:#737575;font:12px arial, helvetica, sans-serif;">
                            <img src="http://www.happy-giraffe.ru/images/mail/icon_views.gif"
                                 style="margin-right:5px;vertical-align:top;"><?php echo PageView::model()->viewsByPath(ltrim($model->url, '.'), true); ?>
                        </span>
                        </td>
                        <?php endif; ?>
                        <td style="padding-right:15px;">
                        <span style="color:#31a4f6;font:12px arial, helvetica, sans-serif;">
                            <a href="http://www.happy-giraffe.ru<?php echo ltrim($model->getUrl(), '.') ?>#comment_list" target="_blank" style="color:#31a4f6;font:12px arial, helvetica, sans-serif;"><img
                                src="http://www.happy-giraffe.ru/images/mail/icon_comments.gif"
                                style="margin-right:5px;vertical-align:top;"><?php echo $model->getCommentsCount() ?></a></span>
                        </td>
                        <td>
                            <?php $used = array(); ?>
                            <?php $j = 0; foreach ($model->getUnknownClassComments() as $comment): ?>
                            <?php if (!empty($comment->author->avatar_id) && !in_array($comment->author->avatar_id, $used)):?>
                                <?php $j++;$used[] = $comment->author->avatar_id ?>
                                <img src="<?php echo $comment->author->getAvatarUrl(Avatar::SIZE_MICRO) ?>"
                                     style="margin-right:5px;-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;">
                                <?php if ($j == 5) break; ?>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

    </td>
    <?php $i++; ?>
        <?php if ($i % 2 == 0 && $i != count($models)):?>
                        </tr>
                    </tbody>
                </table>
                    <table style="width:100%;margin-bottom:50px;" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                <?php endif ?>
        <?php endif; ?>
    <?php endforeach; ?>

        </tr>
    </tbody>
</table>