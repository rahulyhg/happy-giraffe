<?php
if(isset($this->model) && method_exists($this->model, 'isValentinePost') && $this->model->isValentinePost()){
    //костыль для валентина 2
   $url = $this->model->getUrl(false, true);
} elseif (!empty($this->url)){
    $url = $this->url;
}else
    $url = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

$code=substr(sha1(microtime()), 0, 5);
?>
<script type="text/javascript">
    $('.vk_share_button<?=$code ?>').html(VK.Share.button('<?= $url?>',{type: 'round', text: 'Мне нравится'}));
</script>
<div class="like-block fast-like-block">
    <div class="box-2">
        <?php
        $this->render('_yh_min', array(
            'options' => $this->providers['yh'],
        ));
        ?>
    </div>

    <div class="box-1">

        <div class="share_button">
            <div class="fb-custom-like">
                <?=HHtml::link('<i class="icon-fb"></i>Мне нравится',
                    'http://www.facebook.com/sharer/sharer.php?u='.urlencode($url),
                    array('class'=>'fb-custom-text', 'onclick'=>'return Social.showFacebookPopup(this);'), true) ?>
                <div class="fb-custom-share-count ajax-el">0</div>
                <script type="text/javascript">
                    $.getJSON("http://graph.facebook.com", { id:"<?=$url ?>" }, function (json) {
                        $('.fb-custom-share-count.ajax-el').html(json.shares || '0');
                    });
                </script>
            </div>
        </div>

        <div class="share_button">
            <div class="vk_share_button<?=$code ?>"></div>
        </div>

        <div class="share_button">
            <div id="ok_shareWidget<?=$code ?>" style="height: 20px;"></div>
            <script>
                !function (d, id, did, st) {
                    var js = d.createElement("script");
                    js.src = "http://connect.ok.ru/connect.js";
                    js.onload = js.onreadystatechange = function () {
                        if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                            if (!this.executed) {
                                this.executed = true;
                                setTimeout(function () {
                                    OK.CONNECT.insertShareWidget(id,did,st);
                                }, 0);
                            }
                        }};
                    d.documentElement.appendChild(js);
                }(document,"ok_shareWidget<?=$code ?>","<?=$url ?>","{width:100,height:20,st:'straight',sz:20,ck:1}");
            </script>
        </div>

        <div class="share_button">
            <div class="tw_share_button" style="height: 20px;">
                <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru" data-text="<?=$this->options['title'] ?>" data-url="<?=$url?>">Твитнуть</a>
                <script type="text/javascript">
                    twttr.widgets.load();
                </script>
            </div>
        </div>
    </div>

    <div class="box-3">
        <div class="rating"><span><?= Rating::model()->countByEntity($this->model, false) ?></span></div>
        <?php if ($this->notice != ''): ?>
        <div class="icon-info">
            <div class="tip">
                <?= $this->notice; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>