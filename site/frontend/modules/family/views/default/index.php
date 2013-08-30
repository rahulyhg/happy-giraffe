<?php
Yii::app()->clientScript
    ->registerPackage('ko_family')
;
$this->widget('PhotoCollectionViewWidget', array('registerScripts' => true));
?>

<div class="content-cols clearfix">
    <div class="col-1">
        <div class="b-ava-large">
            <div class="b-ava-large_ava-hold clearfix">
                <a class="ava large" href="">
                    <img alt="" src="/images/example/ava-large.jpg">
                </a>
                <span class="b-ava-large_online">На сайте</span>
                <a href="" class="b-ava-large_bubble b-ava-large_bubble__dialog powertip" title="Начать диалог">
                    <span class="b-ava-large_ico b-ava-large_ico__mail"></span>
                    <span class="b-ava-large_bubble-tx">+5</span>
                </a>
                <a href="" class="b-ava-large_bubble b-ava-large_bubble__photo powertip" title="Фотографии">
                    <span class="b-ava-large_ico b-ava-large_ico__photo"></span>
                    <span class="b-ava-large_bubble-tx">+50</span>
                </a>
                <a href="" class="b-ava-large_bubble b-ava-large_bubble__blog powertip" title="Записи в блоге">
                    <span class="b-ava-large_ico b-ava-large_ico__blog"></span>
                    <span class="b-ava-large_bubble-tx">+999</span>
                </a>
            </div>
            <div class="textalign-c">
                <a href="" class="b-ava-large_a">Александр Богоявленский</a>
            </div>
        </div>

        <div class="b-family b-family__bg-white">
            <div class="b-family_top b-family_top__blue"></div>
            <ul class="b-family_ul">
                <li class="b-family_li">
                    <div class="b-family_img-hold">
                        <!-- Размеры изображений 55*55пк -->
                        <img src="/images/example/w41-h49-1.jpg" alt="" class="b-family_img">
                    </div>
                    <div class="b-family_tx">
                        <span>Я</span> <br>
                        <span>Иван</span>
                    </div>
                </li>
                <li class="b-family_li">
                    <div class="b-family_img-hold">
                        <img src="/images/example/w60-h40.jpg" alt="" class="b-family_img">
                    </div>
                    <div class="b-family_tx">
                        <span>Жена</span> <br>
                        <span>Елена</span>
                    </div>
                </li>
                <li class="b-family_li">
                    <div class="b-family_img-hold">
                        <img src="/images/example/w64-h61-1.jpg" alt="" class="b-family_img">
                    </div>
                    <div class="b-family_tx">
                        <span>Дочь</span> <br>
                        <span>Снежана</span> <br>
                        <span>2,5 года</span>
                    </div>
                </li>
                <li class="b-family_li">
                    <div class="b-family_img-hold">
                        <div class="ico-family ico-family__girl-small"></div>
                    </div>
                    <div class="b-family_tx">
                        <span>Дочь</span> <br>
                        <span>Снежана</span> <br>
                        <span>2,5 года</span>
                    </div>
                </li>
                <li class="b-family_li">
                    <div class="b-family_img-hold">
                        <div class="ico-family ico-family__boy-small"></div>
                    </div>
                    <div class="b-family_tx">
                        <span>Дочь</span> <br>
                        <span>Снежана</span> <br>
                        <span>2,5 года</span>
                    </div>
                </li>
            </ul>
            <div class="textalign-c">
                <!-- Для удобства число можно положить в span или другой строчный тег -->
                <span class="font-big padding-r5"> Членов семьи: 5 </span>
                <a href="" class="a-pseudo font-middle">Изменить</a>
            </div>
        </div>

    </div>

    <div class="col-23-middle clearfix">
        <div class="heading-title">
            Моя семья
            <div class="float-r position-r">
                <span class="font-big padding-r5"> Членов семьи: 5 </span>
                <a href="" class="a-pseudo font-middle">Изменить</a>
            </div>
        </div>
        <div class="col-gray padding-20">

            <div class="family-settings clearfix">
                <div class="family-settings_hold clearfix">
                    <div class="family-settings_photo">
                        <div class="family-settings_photo-hold">
                            <img src="/images/example/w220-h165-1.jpg" alt="" class="family-settings_photo-img">
                        </div>
                    </div>
                    <div class="family-settings_desc">
                        <div class="form-settings">
                            <div class="form-settings_label-row">Я</div>
                            <div class="">
                                <span class="form-settings_name">Иван</span>
                                <a href="" class="a-pseudo-icon powertip" title="Редактировать">
                                    <span class="ico-edit"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- max-width 640px -->
                <div class="photo-preview-row photo-preview-row__add clearfix">
                    <h3 class="heading-small margin-b10">Мои фото</h3>
                    <div class="photo-preview-row_hold">
                        <div class="photo-grid clearfix">
                            <div class="photo-grid_row clearfix">
                                <!-- Высота фотографий 105пк -->
                                <div class="photo-grid_i">
                                    <img alt="" src="/images/example/photo-grid-7.jpg" class="photo-grid_img">
                                    <div class="photo-grid_overlay">
                                        <span class="photo-grid_zoom"></span>
                                        <div class="photo-grid_overlay-row">
                                            <label for="photo-grid_check1" class="photo-grid_checbox-label powertip" title="Сделать основным">
                                                <input type="checkbox" name="" id="photo-grid_check1" class="photo-grid_checkbox">
                                            </label>
                                            <div class="float-r">
                                                <a href="" class="ico-del ico-del__white powertip" title="Удалить"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="photo-grid_i">
                                    <img alt="" src="/images/example/photo-grid-8.jpg" class="photo-grid_img">
                                    <div class="photo-grid_overlay">
                                        <span class="photo-grid_zoom"></span>
                                        <div class="photo-grid_overlay-row">
                                            <label for="photo-grid_check1" class="photo-grid_checbox-label powertip" title="Сделать основным">
                                                <input type="checkbox" name="" id="photo-grid_check1" class="photo-grid_checkbox">
                                            </label>
                                            <div class="float-r">
                                                <a href="" class="ico-del ico-del__white powertip" title="Удалить"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="photo-grid_i">
                                    <img alt="" src="/images/example/photo-grid-9.jpg" class="photo-grid_img">
                                    <div class="photo-grid_overlay">
                                        <span class="photo-grid_zoom"></span>
                                        <div class="photo-grid_overlay-row">
                                            <label for="photo-grid_check1" class="photo-grid_checbox-label powertip" title="Сделать основным">
                                                <input type="checkbox" name="" id="photo-grid_check1" class="photo-grid_checkbox">
                                            </label>
                                            <div class="float-r">
                                                <a href="" class="ico-del ico-del__white powertip" title="Удалить"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="photo-grid_i">
                                    <img alt="" src="/images/example/photo-grid-10.jpg" class="photo-grid_img">
                                    <div class="photo-grid_overlay">
                                        <span class="photo-grid_zoom"></span>
                                        <div class="photo-grid_overlay-row">
                                            <label for="photo-grid_check1" class="photo-grid_checbox-label powertip" title="Сделать основным">
                                                <input type="checkbox" name="" id="photo-grid_check1" class="photo-grid_checkbox">
                                            </label>
                                            <div class="float-r">
                                                <a href="" class="ico-del ico-del__white powertip" title="Удалить"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="photo-grid_i">
                                    <img alt="" src="/images/example/photo-grid-12.jpg" class="photo-grid_img">
                                    <div class="photo-grid_overlay">
                                        <span class="photo-grid_zoom"></span>
                                        <div class="photo-grid_overlay-row">
                                            <label for="photo-grid_check1" class="photo-grid_checbox-label powertip" title="Сделать основным">
                                                <input type="checkbox" name="" id="photo-grid_check1" class="photo-grid_checkbox">
                                            </label>
                                            <div class="float-r">
                                                <a href="" class="ico-del ico-del__white powertip" title="Удалить"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <a href="" class="photo-preview-row_add"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ko template: { name : 'member-template', data : partner, if : partner() !== null } --><!-- /ko-->
            <!-- ko template: { name : 'member-template', foreach : normalBabies } --><!-- /ko -->



            <div class="family-settings clearfix">
                <a href="" class="ico-close2 powertip family-settings_del" title="Удалить"></a>
                <div class="family-settings_hold clearfix">
                    <div class="family-settings_photo">
                        <div class="family-settings_photo-hold">
                            <div class="ico-family-big ico-family-big__boy-wait"></div>
                        </div>
                    </div>
                    <div class="family-settings_desc">
                        <div class="form-settings">
                            <div class="form-settings_label-row">Мы ждем мальчика</div>
                            <div class="form-settings_label-row">Приблизительная дата родов</div>
                            <div class="clearfix">
                                <div class="form-settings_elem">
                                    <div class="">
                                        <span class="">28 января 1989 г.</span>
                                        <a href="" class="a-pseudo-icon">
                                            <span class="ico-edit"></span>
                                        </a>
                                    </div>
                                    <!-- Блок редатирования поля -->
                                    <div class="clearfix display-n">
                                        <div class="w-90 float-l margin-r10">
                                        <div class="chzn-gray">
                                            <select class="chzn">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                                <option>06</option>
                                                <option>07</option>
                                                <option>08</option>
                                                <option>09</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="w-100 float-l margin-r10">
                                        <div class="chzn-gray">
                                            <select class="chzn">
                                                <option>января</option>
                                                <option>февраля</option>
                                                <option>марта</option>
                                                <option>апреля</option>
                                                <option>майя</option>
                                                <option>июня</option>
                                                <option>июля</option>
                                                <option>августа</option>
                                                <option>сентября</option>
                                                <option>октября</option>
                                                <option>ноября</option>
                                                <option>декабря</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="w-90 float-l">
                                        <div class="chzn-gray">
                                            <select class="chzn">
                                                <option>1910</option>
                                                <option>1911</option>
                                                <option>1912</option>
                                                <option>1913</option>
                                                <option>1914</option>
                                                <option>1915</option>
                                                <option>1916</option>
                                                <option>1917</option>
                                                <option>1918</option>
                                                <option>1919</option>
                                                <option>1920</option>
                                                <option>1921</option>
                                                <option>1922</option>
                                            </select>
                                        </div>
                                        </div>
                                        <button class="btn-green btn-small margin-l10">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<iframe name="partner-upload-target" id="partner-upload-target" style="display: none;"></iframe>
<iframe name="baby-upload-target" id="baby-upload-target" style="display: none;"></iframe>

<script type="text/javascript">
    $(function() {
        familyMainVM = new FamilyMainViewModel(<?=CJSON::encode($json)?>);
        ko.applyBindings(familyMainVM);
    });
</script>

<script type="text/html" id="member-template">
    <div class="family-settings clearfix">
        <a href="" class="ico-close2 powertip family-settings_del" title="Удалить"></a>
        <div class="family-settings_hold clearfix">
            <div class="family-settings_photo">
                <div class="family-settings_photo-hold">
                    <!-- ko if: photoToShow() !== null -->
                    <img alt="" class="family-settings_photo-img" data-bind="attr: { src : photoToShow().bigThumbSrc }">
                    <!-- /ko -->
                    <!-- ko if: photoToShow() === null -->
                    <div class="ico-family-big" data-bind="css: bigCssClass()"></div>
                    <!-- /ko -->
                </div>
            </div>
            <div class="family-settings_desc">
                <div class="form-settings">
                    <div class="form-settings_label-row" data-bind="text: titleLabel()"></div>

                    <div class="clearfix">
                        <div class="form-settings_elem">
                            <!-- ko if: ! nameBeingEdited() -->
                            <span class="form-settings_name" data-bind="text: name"></span>
                            <a class="a-pseudo-icon powertip" title="Редактировать" data-bind="click: editName">
                                <span class="ico-edit"></span>
                            </a>
                            <!-- /ko -->
                            <!-- ko if: nameBeingEdited -->
                            <div class="float-l w-300">
                                <input type="text" value="Ангелина" class="itx-gray" data-bind="value: nameValue">
                            </div>
                            <button class="btn-green btn-small margin-l10" data-bind="click: saveName">Ok</button>
                            <!-- /ko -->
                        </div>
                    </div>
                    <!-- ko if: $data instanceof FamilyMainBaby -->
                    <div class="form-settings_label-row" data-bind="text: birthdayLabel()"></div>
                    <div class="clearfix">
                        <div class="form-settings_elem">
                            <!-- ko if: ! birthdayBeingEdited() -->
                            <span data-bind="text: birthdayText"></span>
                            <a class="a-pseudo-icon" data-bind="click: editBirthday">
                                <span class="ico-edit"></span>
                            </a>
                            <!-- /ko -->
                            <!-- ko if: birthdayBeingEdited -->
                            <div class="clearfix">
                                <div class="w-90 float-l margin-r10">
                                    <div class="chzn-gray">
                                        <select data-bind="options: $root.days, value: dayValue, chosen: {}" data-placeholder="день"></select>
                                    </div>
                                </div>
                                <div class="w-100 float-l margin-r10">
                                    <div class="chzn-gray">
                                        <select class="chzn" data-bind="options: $root.monthes, optionsText: 'name', optionsValue: 'id', value: monthValue, chosen: {}" data-placeholder="месяц"></select>
                                    </div>
                                </div>
                                <div class="w-90 float-l">
                                    <div class="chzn-gray">
                                        <select class="chzn" data-bind="options: $root.years, value: yearValue, chosen: {}" data-placeholder="год"></select>
                                    </div>
                                </div>
                                <button class="btn-green btn-small margin-l10" data-bind="click: saveBirthday">Ok</button>
                            </div>
                            <!-- /ko -->
                        </div>
                    </div>
                    <!-- /ko -->
                    <div class="form-settings_label-row">
                        <span data-bind="text: noticeLabel()"></span>
                        <a class="a-pseudo-icon powertip" title="Редактировать" data-bind="click: editNotice, if: ! noticeBeingEdited()">
                            <span class="ico-edit"></span>
                        </a>
                    </div>
                    <!-- ko if: ! noticeBeingEdited() && notice().length > 0 -->
                    <div class="family-settings_about clearfix" data-bind="text: notice"></div>
                    <!-- /ko -->
                    <!-- ko if: noticeBeingEdited -->
                    <div class="family-settings_about clearfix">
                        <div class="w-300">
                            <textarea cols="30" rows="4" class="itx-gray" data-bind="value: noticeValue"></textarea>
                            <div class="clearfix margin-t5">
                                <button class="btn-green  btn-small margin-r5" data-bind="click: saveNotice">Сохранить</button>
                                <a class="btn-gray-light  btn-small" data-bind="click: cancelEditNotice">Отменить</a>
                            </div>
                        </div>
                    </div>
                    <!-- /ko -->
                </div>
            </div>
        </div>
        <div class="photo-preview-row photo-preview-row__add clearfix">
            <h3 class="heading-small margin-b10" data-bind="text: photosLabel()"></h3>
            <div class="photo-preview-row_hold">
                <div class="photo-grid clearfix">
                    <!-- ko foreach: photos -->
                    <div class="photo-grid_i" data-bind="click: open">
                        <img alt="" class="photo-grid_img" data-bind="attr: { src : smallThumbSrc }">
                        <div class="photo-grid_overlay">
                            <span class="photo-grid_zoom"></span>
                            <div class="photo-grid_overlay-row">
                                <label for="photo-grid_check1" class="photo-grid_checbox-label" data-bind="tooltip: 'Сделать основным'">
                                    <input type="checkbox" class="photo-grid_checkbox" data-bind="checked: isMain, click: function() { return true; }, clickBubble: false">
                                </label>
                                <div class="float-r">
                                    <a href="" class="ico-del ico-del__white" data-bind="click: remove, clickBubble: false, tooltip: 'Удалить'"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /ko -->
                    <span class="photo-preview-row_add file-fake">
                        <form method="post" enctype="multipart/form-data" data-bind="attr: { action : PHOTO_UPLOAD_URL, target : PHOTO_UPLOAD_TARGET }">
                            <!-- ko if: $data instanceof FamilyMainBaby -->
                            <input type="hidden" data-bind="value: id" name="id">
                            <!-- /ko -->
                            <input type="file" name="photo" onchange="submit()">
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </div>
</script>