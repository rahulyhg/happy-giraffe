<?php
$this->pageTitle = 'Создание фотоальбома' ;
$cs = Yii::app()->clientScript;
$cs->registerAMD('photo-albums-create', array('kow'));
?>

<div class="b-main_cont">
    <photo-albums-create>
        <div class="position-rel" style="height: 350px; width: 560px; margin-top: 10px;">
            <div class="b-loader b-loader__abs">
                <div class="b-loader_hold">
                  <div vars.size class="b-loader_circle"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 125 125" enable-background="new 0 0 125 125"><defs><path id="a" d="M62.5 0C28 0 0 28 0 62.5S28 125 62.5 125 125 97 125 62.5 97 0 62.5 0zm0 112.5c-27.6 0-50-22.4-50-50s22.4-50 50-50 50 22.4 50 50-22.4 50-50 50z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path fill-rule="evenodd" clip-rule="evenodd" fill="#AA96D2" d="M2 8.7l60.2 54.4 32.7-75z" clip-path="url(#b)"/><path fill-rule="evenodd" clip-rule="evenodd" fill="#FF8232" d="M94.6-11.8l-33 74.6 82.2 6.6z" clip-path="url(#b)"/><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFE641" d="M61.1 62.6l19.9 79 62.8-73.2z" clip-path="url(#b)"/><path fill-rule="evenodd" clip-rule="evenodd" fill="#64B9EB" d="M61.6 62.8l-68.4 39.7 88 38.6z" clip-path="url(#b)"/><path fill-rule="evenodd" clip-rule="evenodd" fill="#73C869" d="M3.1 8.6l-9 94.6 67.8-40.4z" clip-path="url(#b)"/></svg>
                  </div>
                  <div class="b-loader_tx"> Загрузка создания</div>
            </div>
        </div>
    </photo-albums-create>
</div>