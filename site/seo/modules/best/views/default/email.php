<?php
/* @var $this DefaultController */

//выбираем 3 понедельника - 2 предыдущих и один следующий
$days = array(date('Y-m-d'));
$i = 1;
?>

<div class="block clearfix">
    <div class="clearfix" style="margin-bottom: 25px;">
        <form action="http://www.happy-giraffe.ru/site/send/">
            <textarea type="text" rows="2" cols="100" name="subject"></textarea>
            <p><input type="button" value="Отправить тестовую" onclick="sendCampaign(this, false)" class="adidas"></p>
            <p><br><br></p>
            <p><input type="button" value="Отправить реальную" onclick="sendCampaign(this, true)"></p>
        </form>
    </div>

    <?php foreach ($days as $day): ?>
        <div class="clearfix">
            <div class="b-best<?php if ($day == date("Y-m-d")) echo ' b-best__today' ?>">
                <?php if ($day == date("Y-m-d")):?>
                    <div class="b-best_t">
                        <span class="b-best_t-date"><?= Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($day)) ?></span>
                        СЕГОДНЯ
                    </div>
                <?php endif ?>
                <?php if ($day != date("Y-m-d")):?>
                    <div class="clearfix margin-b20">
                        <div class="b-date"><?= Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($day)) ?></div>
                    </div>
                <?php endif ?>
                <div class="best-list best-list__mail">
                    <ul id="sortable<?= $i ?>" class="best-list_ul" data-date="<?= $day ?>">
                        <?php $models = Favourites::getListByDate(Favourites::WEEKLY_MAIL, $day) ?>
                        <?php foreach ($models as $model): ?>
                            <?php $article = $model->getArticle() ?>
                            <?php if ($article instanceof CommunityContent): ?>
                            <li class="best-list_li b-best_i" id="<?= $model->_id ?>">

                                <div class="user-info clearfix">
                                    <a href="" class="ava"><img src="<?= SeoUser::getAvatarUrlForUser($article->author, 72) ?>"/></a>
                                    <div class="user-info_details">
                                        <a href="" class="user-info_username"><?= $article->author->first_name ?></a>
                                    </div>
                                </div>

                                <div class="best-list_date"><?=  Yii::app()->dateFormatter->format("d MMMM yyyy, H:mm", $article->created); ?></div>

                                <b class="best-list_t"><a href=""><?= $article->title ?></a></b>

                                <div class="best-list_tx">
                                    <?php $photo = $article->content->getPhoto(); ?>
                                    <?php if (!empty($photo)):?>
                                        <?php $src = implode('/', array(Yii::app()->params['photos_url'],'thumbs','580x1000',$photo->author_id,$photo->fs_name)); ?>
                                        <img src="<?=$src ?>" alt="" width="318"/>
                                    <?php endif ?>
                                    <p><?= $article->getContentText(450); ?>
                                        <a href="" class="best-list_more">Читать всю запись</a>
                                    </p>
                                </div>

                                <div class="best-list_row clearfix">
                                    <span class="best-list_views"><?= PageView::model()->viewsByPath(ltrim($article->url, '.'), true); ?></span>
                                    <a href="" class="best-list_comments"><?= $article->getCommentsCount() ?></a>
                                    <?php $used = array(); ?>
                                    <?php $j = 0; foreach ($article->getUnknownClassComments() as $comment): ?>
                                        <?php if (!empty($comment->author->avatar_id) && !in_array($comment->author->avatar_id, $used)):?>
                                            <?php $j++;$used[] = $comment->author->avatar_id ?>
                                                <a href="" class="ava small"><img src="<?= SeoUser::getAvatarUrlForUser($comment->author, 24) ?>"></a>
                                            <?php if ($j == 5) break; ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>

                                <div class="b-best_overlay">
                                    <div class="b-best_overlay-tx">
                                        Вы можете переместить или удалить. <br>
                                        <a href="http://www.happy-giraffe.ru<?= $article->url ?>" target="_blank">Перейти
                                            на пост</a>
                                    </div>
                                </div>
                                <a href="javascript:;" class="b-best_close"
                                   onclick="EditFavourites.remove('<?= $model->_id ?>', this);"></a>
                                <a href="" class="b-best_drag"></a>
                            </li>
                            <?php endif; ?>
                            <?php if ($article instanceof \site\frontend\modules\posts\models\Content): ?>
                                <?php $this->renderPartial('_content', compact('article', 'model')); ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>

</div>
<script type="text/javascript">
    function sendCampaign(el, real) {
        var form = $(el).parents('form');
        var data = form.serialize();
        if (real) {
            data += '&real=1';
        }
        form.find('input[type=button]').each(function(el) {
            $(el).attr('disabled', 'disabled');
        });
        $.post(form.attr('action'), data, function(response) {
            var text = response.success ? 'Отправлено' : 'Ошибка: ' + response.error;
            alert(text);
        }, 'json');
    }

    $(function () {
        $("#sortable1, #sortable2, #sortable3").sortable({
            connectWith: ".best-list_ul",
            update: function (event, ui) {
                var id = ui.item[0].id;
                var new_list_index = ui.item.index();
                var date = ui.item.parents('ul').data('date');

                $.post('/best/newPos/', {id: id, index: new_list_index, date: date}, function (response) {
                    if (!response.status) {
                        alert('Ошибка, обратитесь к разработчику');
                    }
                }, 'jsonp');
            }
        });
    });
</script>
<style type="text/css">
    .best-list_ul {
        min-width: 300px;
        min-height: 50px;
    }
    .best-list_li{
        min-width: 300px;
    }
</style>