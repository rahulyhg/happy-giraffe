<!--<p><a onclick="return Social.open('vk', this.href, 'Опубликовать ссылку во Вконтакте', 800, 300);" title="Опубликовать ссылку во ВКонтакте" href="http://vkontakte.ru/share.php?url=http://happyfront/community/2/forum/post/447/&image=http://i027.radikal.ru/1111/f9/ffc27bf8f55c.jpg&title=<?php /*echo urlencode('Рецепты для борьбы с токсикозом') */?>&description=<?php /*echo urlencode('Моя беременность протекала поначалу с ярко выраженными симптомами токсикоза.Хочу поделиться  рецептами,которые..') */?>">Опубликовать ссылку во ВКонтакте</a></p>-->
<!--<p><a onclick="return Social.open('fb', this.href, 'Опубликовать ссылку в Facebook', 800, 300);" title="Опубликовать ссылку в Facebook" href="http://www.facebook.com/sharer.php?u=http://www.happy-giraffe.ru/community/2/forum/post/4600/">Опубликовать ссылку во Facebook</a></p>-->
<!--<p><a onclick="socwin = window.open(this.href, 'mmir', 'width=626, height=436'); return false;" href="http://connect.mail.ru/share?share_url=<?php /*echo urlencode('http://www.happy-giraffe.ru/community/2/forum/post/4600/'); */?>&title=liketest&imageurl=<?php /*echo urlencode('http://i027.radikal.ru/1111/f9/ffc27bf8f55c.jpg'); */?>">Поделиться с друзьями Моего Мира на Mail.ru</a></p>-->
<!--<p><a onclick="socwin = window.open(this.href, 'odkl', 'width=626, height=436'); return false;" rel="nofollow" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php /*echo urlencode('http://www.happy-giraffe.ru/community/2/forum/post/4600/'); */?>">Поделиться с друзьями в Одноклассниках</a></p>-->
<!--<p><a onclick="socwin = window.open(this.href, 'odkl', 'width=626, height=436'); return false;" rel="nofollow" href="http://twitter.com/intent/tweet?text=<?php /*echo urlencode('Рецепты для борьбы с токсикозом. http://www.happy-giraffe.ru/community/2/forum/post/4600/'); */?>">Поделиться с друзьями в Twitter</a></p>-->
<!--<p><a onclick="socwin = window.open(this.href, 'odkl', 'width=626, height=436'); return false;" rel="nofollow" href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php /*echo urlencode('http://www.happy-giraffe.ru/community/2/forum/post/4600/'); */?>&title=<?php /*echo urlencode('Рецепты для борьбы с токсикозом.'); */?>">Поделиться с друзьями в +1</a></p>-->
<div class="like-block clearfix">
    <div class="tip">
        <div class="container">
            <i class="icon-question"></i>

            <div class="text">
                <big><?php echo $this->title; ?></big>

                <p>Как правило, кроватку новорождому приобретают незадолго до его появления на свет. При этом многие
                    молодые родители обращают внимание главным образом на ее внешний вид.</p>

                <p>Как правило, кроватку новорождому приобретают незадолго до его появления на свет. При этом многие
                    молодые родители обращают внимание главным образом на ее внешний вид.</p>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="title">Вам полезна статья? Отметь!</div>
    </div>

    <div class="like-buttons clearfix">

        <div class="hg-like like-btn">
            <?php
            $this->render('_yh', array(
                'options' => $this->providers['yh'],
            ));
            ?>
        </div>

        <div class="other-likes">
            <ul class="">
                <li><div class="like-btn"><?php $this->render('_vk', array($this->providers['vk'])); ?></div></li>
                <li><div class="like-btn"><?php $this->render('_gp', array($this->providers['gp'])); ?></div></li>
                <li><div class="like-btn"><?php $this->render('_mr', array($this->providers['mr'])); ?></div></li>
                <li><div class="like-btn"><?php $this->render('_fb', array($this->providers['fb'])); ?></div></li>
                <li><div class="like-btn"><?php $this->render('_tw', array($this->providers['tw'])); ?></div></li>
                <li><div class="like-btn"><?php $this->render('_ok', array($this->providers['ok'])); ?></div></li>
            </ul>
        </div>
    </div>

    <div class="rating">
        <span><?php echo Rating::model()->countByEntity($this->model, false) ?></span><br/>рейтинг
    </div>

</div>
