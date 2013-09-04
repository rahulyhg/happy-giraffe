<?php
Yii::app()->clientScript->registerMetaTag('NWGWm2TqrA1HkWzR8YBwRT08wX-3SRzeQIBLi1PMK9M', 'google-site-verification');
Yii::app()->clientScript->registerMetaTag('41ad6fe875ade857', 'yandex-verification');
$this->widget('application.widgets.registerWidget.RegisterWidget');
$this->widget('application.widgets.loginWidget.LoginWidget');
Yii::app()->clientScript
    ->registerScriptFile('/javascripts/jquery.fitvids.js')
;
?>

<div class="start-page">

	<div class="start-page_row start-page_row__head">
		<div class="start-page_hold">
			<div class="start-page_head clearfix">
				<h1 class="logo logo__big">
					<span class="logo_i" title="Веселый жираф - сайт для все семьи">Веселый жираф - сайт для все семьи</span>
					<strong class="logo_slogan">САЙТ ДЛЯ ВСЕЙ СЕМЬИ</strong>
				</h1>
				<div class="start-page_head-desc">
                    <a class="btn-green btn-big fancy" href="#register" data-theme="transparent">Присоединяйтесь!</a>
                    <div class="clearfix">
                        <a class="display-ib verticalalign-m fancy" href="#login" data-theme="transparent">Войти</a>
                        <span class="i-or">или</span>
                        <?php Yii::app()->eauth->renderWidget(array('action' => 'site/login', 'mode' => 'home', 'predefinedServices' => array('odnoklassniki', 'vkontakte', 'facebook', 'twitter'))); ?>
                    </div>
                </div>

			</div>
		</div>
	</div>

	<?php $this->widget('application.widgets.home.CounterWidget')?>

	<div class="start-page_row start-page_row__articles">
		<div class="start-page_hold">
			<div class="start-page_articles">

                <?php foreach ($models as $model): ?>
                    <?php $this->renderPartial('_article', array('model' => $model)); ?>
                <?php endforeach; ?>

                <?php if (false): ?>
                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">Готовим список: что взять с собой на море с ребенком? </a>
                            </div>
                            <div class="b-article-prev_in">
                                <div class="b-article_in-img">
                                    <iframe width="235" height="129" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/pehSAUTqjRs?wmode=transparent"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">ГотовимсписокГотовимсписокГотовимсписок: </a>
                            </div>
                            <div class="b-article-prev_in">
                                <div class="b-article_in-img">
                                    <!-- img width 235px -->
                                    <img alt="Ночные гости - кто они фото 1" class="content-img" src="http://img.happy-giraffe.ru/thumbs/700x700/56/edad8d334a0b4a086a50332a2d8fd0fe.JPG" title="Ночные гости - кто они фото 1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">Здоровая пища для кошек породы бурмилла: </a>
                            </div>
                            <div class="b-article-prev_in">
                                <div class="b-article_in-img">
                                    <img alt="Ночные гости - кто они фото 1" class="content-img" src="/images/example/w440-h340.jpg" title="Ночные гости - кто они фото 1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">Здоровая пища </a>
                            </div>
                            <div class="b-article-prev_in">
                                <div class="b-article_in-img">
                                    <img alt="Ночные гости - кто они фото 1" class="content-img" src="/images/example/left-sidebar-test-1.jpg" title="Ночные гости - кто они фото 1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">Здоровая пища для кошек породы бурмилла: </a>
                            </div>
                            <div class="b-article-prev_in">
                                <div class="b-article_in-img">
                                    <img alt="Ночные гости - кто они фото 1" class="content-img" src="/images/example/w580-h385.jpg" title="Ночные гости - кто они фото 1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="b-article b-article-prev clearfix">
                        <div class="float-l">
                            <div class="like-control like-control__smallest clearfix">
                                <a href="" class="ava middle">
                                    <img alt="" src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg">
                                </a>
                                <a class="like-control_ico like-control_ico__like powertip" href="" title="Нравиться">5</a>
                                <div class="position-r">
                                    <a class="like-control_ico like-control_ico__repost powertip" title="Репост" href="">5</a>
                                </div>
                                <div class="favorites-control">
                                    <a class="favorites-control_a powertip" href="" title="В избранное">789</a>
                                </div>
                            </div>
                        </div>
                        <div class="b-article-prev_cont clearfix">
                            <div class="clearfix">
                                <div class="meta-gray">
                                    <a class="meta-gray_comment" href="">
                                        <span class="ico-comment ico-comment__gray"></span>
                                        <span class="meta-gray_tx">35</span>
                                    </a>
                                    <div class="meta-gray_view">
                                        <span class="ico-view ico-view__gray"></span>
                                        <span class="meta-gray_tx">305</span>
                                    </div>
                                </div>
                                <div class="float-l">
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                            </div>
                            <div class="b-article-prev_t clearfix">
                                <a class="b-article-prev_t-a" href="">Пол ребенка по группе крови родителей </a>
                            </div>
                            <div class="b-article-prev_in">
                                <p>По мнению китайских мудрецов, узнать пол будущего малыша можно по возрасту женщины на момент зачатия. Исходя из того, что в Китае семья может иметь только одного малыша и малыш...</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

			</div>
		</div>
	</div>

	<div class="start-page_row start-page_row__club">
		<div class="start-page_hold">
			<div class="start-page_club">
				<h2 class="start-page_club-t">Выбирайте клубы по интересам</h2>
				<ul class="start-page_club-ul clearfix">
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>1)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/1.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Беременность <br>и дети</span>
						</a>
					</li>
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>2)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/2.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Наш дом</span>
						</a>
					</li>
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>3)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/4.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Муж и жена</span>
						</a>
					</li>
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>4)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/3.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Красота <br> и здоровье</span>
						</a>
					</li>
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>5)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/5.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Интересы <br> и увлечения</span>
						</a>
					</li>
					<li class="start-page_club-li">
						<a href="<?=$this->createUrl('/community/default/section', array('section_id'=>6)) ?>" class="start-page_club-i">
							<img src="/images/club/collection/6.png" alt="" class="start-page_club-img">
							<span class="start-page_club-tx">Семейный <br> отдых</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="start-page_row start-page_row__join">
		<div class="start-page_hold">
			<div class="start-page_join">
				<a class="btn-green start-page_join-btn fancy" href="#register" data-theme="transparent">Присоединяйтесь!</a>
                <div class="clearfix">
                    <span class="i-or">войти через</span>
                    <?php Yii::app()->eauth->renderWidget(array('action' => 'site/login', 'mode' => 'home', 'predefinedServices' => array('odnoklassniki', 'vkontakte', 'facebook', 'twitter'))); ?>
                </div>
			</div>
		</div>
	</div>

	<div class="footer-push"></div>
    <?php $this->renderPartial('//_footer'); ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".b-article_in-img").fitVids({ customSelector : "iframe[src*='rutube.ru']" });
    });
</script>