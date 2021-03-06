<?php
/**
 * @var $form site\frontend\modules\photo\models\upload\PopupForm
 */
?>

<div id="photo-tab-computer" class="tab-pane">
    <div class="popup-add_frame popup-add_frame__multi" data-bind="visible: photos().length == 0">
        <div class="popup-add_cap">
            <div class="cap-empty cap-empty__addPhoto">
                <div class="cap-empty_hold">
                    <div class="cap-empty_img"></div>
                    <div class="cap-empty_t">Выберите файлы с компьютера</div>
                    <div class="cap-empty_tx-sub"><div class='file-fake'><div class='btn btn-s btn-primary file-fake_btn'>Обзор</div><input type='file' class='file-fake_inp' name="image" data-bind="fileUpload: fileUploadSettings" accept="image/gif, image/jpeg, image/png" multiple></div>  <div class='popup-add_cap-desc'>Разрешенные форматы файлов JPG, GIF, PNG.<br> Максимальный размер 8 Мб.</div><div class='popup-add_cap-drag' data-bind="visible: multiple">или перетащите фотографии сюда</div></div>
                </div>
                <div class="verticalalign-m-help"></div>
            </div>
        </div>
    </div>

    <div class="popup-add_scroll scroll" data-bind="visible: photos().length > 0">
        <div class="popup-add_frame popup-add_frame__multi">
            <div class="scroll_scroller">
                <ul class="popup-add_multi scroll_cont">
                    <!-- ko foreach: photos -->
                    <li class="popup-add_multi-li" data-bind="template: 'photo-template'">

                    </li>
                    <!-- /ko -->
                </ul>
            </div>
            <div class="scroll_bar-hold">
                <div class="scroll_bar">
                    <div class="scroll_bar-in"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-add_footer clearfix" data-bind="visible: photos().length > 0">
        <div class="float-r"><button class="btn btn-success" data-bind="disable: loading, click: add">Добавить</button></div>
        <div class="popup-add_footer-l">
                <span class="color-gray-light">Загружено
                    <span class="popup-add_footer-count" data-bind="text: successPhotos().length"></span> из <span class="popup-add_footer-count" name="image" data-bind="text: photos().length"></span></span>
            <div class="file-fake" data-bind="visible: ! loading()">
                <input type="file" class="file-fake_inp" name="image" data-bind="fileUpload: fileUploadSettingsMore" accept="image/gif, image/jpeg, image/png" multiple><a href="" class="file-fake_btn btn btn-primary btn-s"><span class="ico-plus ico-plus__s ico-plus__white"></span>Загрузить еще</a>
            </div>
            <div class="progress progress-striped active progress__cont progress__inline" data-bind="visible: loading">
                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%" class="progress-bar progress-bar__cont"></div>
            </div><a href="" class="btn-link btn-link-gray btn btn-s" data-bind="click: cancelAll, visible: loading">Отменить загрузку </a>
        </div>
    </div>
</div>

<script type="text/javascript">
    require(['ko_photoUpload', 'knockout'], function(upload, ko) {
        ddd = new upload.FromComputerMultipleViewModel(<?=$form->output()?>);
        ko.applyBindings(ddd, document.getElementById('photo-tab-computer'));
    });
</script>