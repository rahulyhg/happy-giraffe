<?php
$model = AlbumPhoto::model()->findByPk($json['initialPhotoId']);
?>
<script type="text/javascript">
    ko.bindingHandlers.stopBinding = {
        init: function() {
            return { controlsDescendantBindings: true };
        }
    };

    ko.virtualElements.allowedBindings.stopBinding = true;
</script>
<div class="photo-window" id="photo-window">
    <div class="photo-window_w">
        <div class="photo-window_top clearfix">
            <a href="javascript:void(0)" class="photo-window_close" onclick="PhotoCollectionViewWidget.close()"></a>
            <div class="b-user-small float-l">
                <a class="ava small" data-bind="attr: { href : currentPhoto().user.url }, css: currentPhoto().user.avaCssClass"><img data-bind="visible: currentPhoto().user.ava.length > 0, attr: { src : currentPhoto().user.ava }"></a>
                <div class="b-user-small_hold">
                    <a class="b-user-small_name" data-bind="html: currentPhoto().user.firstName + ' <br>' + currentPhoto().user.lastName, attr: { href : currentPhoto().user.url }"></a>
                    <div class="b-user-small_date" data-bind="text: currentPhoto().date"></div>
                </div>
            </div>
            <div class="photo-window_top-hold">
                <div class="photo-window_count" data-bind="text: currentNaturalIndex() + ' фото из ' + count"></div>
                <div class="photo-window_t" data-bind="text: currentPhoto().title"></div>
            </div>

        </div>
        <!-- Обрабатывать клик на юphoto-window_c для листания следующего изображения -->
        <div class="photo-window_c">
            <div class="photo-window_img-hold">
                <img alt="" class="photo-window_img" data-bind="attr: { src : currentPhoto().src }">
                <div class="verticalalign-m-help"></div>
            </div>
            <a class="photo-window_arrow photo-window_arrow__l" data-theme="white-simple" data-bind="click: prevHandler"></a>
            <a class="photo-window_arrow photo-window_arrow__r" data-theme="white-simple" data-bind="click: nextHandler"></a>


            <div class="like-control clearfix">

                <a href="javascript:;" class="like-control_ico like-control_ico__like<?php if (Yii::app()->user->getModel()->isLiked($model)) echo ' active' ?>" onclick="HgLike(this, 'AlbumPhoto',<?=$model->id ?>);"><?=PostRating::likesCount($model) ?></a>
                <!-- ko stopBinding: true -->
                <?php $this->widget('FavouriteWidget', array('model' => $model)); ?>
                <!-- /ko -->
            </div>
        </div>

        <div class="photo-window_bottom">
            <script type="text/javascript">
            $(document).ready(function () {
                $('.photo-window_bottom').click(function(){
                    $(this).toggleClass('active');
                });
            });
            </script>
            <div class="photo-window_desc">
                <p><span>В круглогодичном лечебно-развлекательном лагере «Зеркальный» ежедневно проводятся разнообразные мероприятия и программы - тематические, творческие и интеллектуальные конкурсы, концерты, викторины, активные и спокойные игры, спокойные игры</span> <span class="photo-window_desc-more"> ... <a href="javascript:void(0)" >Читать полностью</a> </span></p>
            </div>
            <div class="photo-window_desc photo-window_desc__full">
                <p>В круглогодичном лечебно-развлекательном лагере «Зеркальный» ежедневно проводятся разнообразные мероприятия и программы - тематические, творческие и интеллектуальные конкурсы, концерты, викторины, активные и спокойные игры, спокойные игры В круглогодичном лечебно-развлекательном лагере</p>
                <p>В круглогодичном лечебно-развлекательном лагере «Зеркальный» ежедневно проводятся разнообразные мероприятия и программы - тематические, творческие и интеллектуальные конкурсы, концерты, викторины, активные и спокойные игры, эстафеты и спокойные игры.  <a href="javascript:void(0)" class="">Кратко</a> </p>
            </div>
        </div>

        <!-- ko stopBinding: true -->
        <?php $this->widget('application.widgets.newCommentWidget.NewCommentWidget', array('model' => $model, 'full' => true, 'gallery' => true)); ?>
        <!-- /ko -->
    </div>
</div>

<script type="text/javascript">
    photoViewVM = new PhotoCollectionViewModel(<?=CJSON::encode($json)?>);
    ko.applyBindings(photoViewVM, document.getElementById('photo-window'));
</script>