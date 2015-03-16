<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="top-nav-fixed ie7"> <![endif]-->
<!--[if IE 8]>         <html class="top-nav-fixed ie8"> <![endif]-->
<!--[if IE 9]>         <html class="top-nav-fixed ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=""> <!--<![endif]-->
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/head.php'; ?>
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,100&amp;subset=latin,cyrillic-ext,cyrillic">

</head>
<body class="body-gray">

	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/top-line-menu.php'; ?>
	
<div class="layout-container">
	<div class="layout-wrapper">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/header-new.php'; ?>
		
		<div class="layout-content clearfix">
		<div class="content-cols clearfix">
			<div class="col-1">
				<div class="sidebar-search clearfix">
					<input type="text" placeholder="Поиск по сайту" class="sidebar-search_itx" id="" name="">
					<!-- 
					В начале ввода текста, скрыть sidebar-search_btn добавить класс active"
					 -->
					<button class="sidebar-search_btn"></button>
				</div>
			</div>
			<div class="col-23-middle">
				<div class="user-add-record user-add-record__small clearfix">
					<div class="user-add-record_ava-hold">
						<a href="" class="ava male middle">
							<span class="icon-status status-online"></span>
							<img alt="" src="http://img.happy-giraffe.ru/avatars/10/ava/f4e804935991c0792e91c174e83f3877.jpg">
						</a>
					</div>
					<div class="user-add-record_hold">
						<div class="user-add-record_tx">Я хочу добавить</div>
						<a href="#popup-user-add-article"  data-theme="transparent" class="user-add-record_ico user-add-record_ico__article fancy powertip" title="Статью"></a>
						<a href="#popup-user-add-photo"  data-theme="transparent" class="user-add-record_ico user-add-record_ico__photo fancy powertip" title="Фото"></a>
						<a href="#popup-user-add-video"  data-theme="transparent" class="user-add-record_ico user-add-record_ico__video fancy active powertip" title="Видео"></a>
						<a href="#popup-user-add-status"  data-theme="transparent" class="user-add-record_ico user-add-record_ico__status fancy powertip" title="Статус"></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="crumbs-small clearfix">
			<ul class="crumbs-small_ul">  
				<li class="crumbs-small_li">Я здесь:</li>
				<li class="crumbs-small_li"><a href="" class="crumbs-small_a">Главная</a></li> &gt;
				<li class="crumbs-small_li"><a href="" class="crumbs-small_a">Наш дом</a></li> &gt;
				<li class="crumbs-small_li"><a href="" class="crumbs-small_a">Цветы в доме</a></li> &gt;
				<li class="crumbs-small_li"><span class="crumbs-small_last">Форум</span></li>
			</ul>
		</div>
		
		<div class="b-section">
			<div class="b-section_hold">
				<div class="content-cols clearfix">
					<div class="col-1">
						<div class="club-list club-list__big clearfix">
							<ul class="club-list_ul textalign-c clearfix">
								<li class="club-list_li">
									<a href="" class="club-list_i">
										<span class="club-list_img-hold">
											<img src="/images/club/2-w130.png" alt="" class="club-list_img">
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-23-middle">
						<div class="padding-l20">
							<div class="b-section_t"><a href="">Цветы в доме</a></div>
							<div class="clearfix">
								<ul class="b-section_ul clearfix">
									<li class="b-section_li"><span class="b-section_li-a active">Форум</span></li>
									<li class="b-section_li"><a href="" class="b-section_li-a">Сервисы</a></li>
									<li class="b-section_li"><a href="" class="b-section_li-a">Конкурсы</a></li>
									<li class="b-section_li"><a href="" class="b-section_li-a">Вопросы-ответы</a></li>
									<li class="b-section_li"><a href="" class="b-section_li-a">Специалисты</a></li>
									<li class="b-section_li"><a href="" class="b-section_li-a">Онлайн-курсы</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="content-cols clearfix">
			<div class="col-23-middle ">
				<div class="clearfix margin-r20 margin-b20">
					<a href="" class="btn-blue btn-h46 float-r">Добавить в клуб</a>
				</div>
				
									
				<div class="b-article clearfix">
					<div class="float-l">
						<div class="like-control like-control__small-indent clearfix">
							<a href="" class="ava male">
								<span class="icon-status status-online"></span>
								<img alt="" src="http://img.happy-giraffe.ru/avatars/10/ava/f4e804935991c0792e91c174e83f3877.jpg">
							</a>
						</div>
						<script>
						$(window).load(function() {
							/*
							block - элемент, что фиксируется
							elementStop - до какого элемента фиксируется
							blockIndent - отступ
							*/
							function likeControlFixedInBlock(block, inBlock, blockIndent) {

								var block = $(block);
								var blockTop = block.offset().top;
								var blockHeight = block.outerHeight();
								/*
								var stopTop = $(elementStop).offset().top;
								var blockStopTop = stopTop - blockTop - blockHeight - blockIndent;
								*/
								var inBlock = $(inBlock);
								var blockStopBottom = inBlock.offset().top + inBlock.outerHeight();
								
								console.log(inBlock.offset().top);
								if (blockStopBottom-blockTop-blockHeight-blockIndent > 20) {

									$(window).scroll(function() {
								        var windowScrollTop = $(window).scrollTop();
								        if (
								        	windowScrollTop > blockTop-blockIndent && 
								        	windowScrollTop + blockHeight < blockStopBottom - blockIndent
								        	) {
								        	block.css({
												'position': 'fixed', 
												'top'     : blockIndent+'px'
											});
								        } else {

											block.css({
												'position': 'relative', 
												'top'     : 'auto'
											});

								        	if (windowScrollTop + blockHeight > blockStopBottom - blockIndent) {
								        		block.css({ 
								        			/* 92 - высота блока над едущими лайками */
													'top'     : inBlock.outerHeight() - blockHeight - 92 
												});
								        	}
								        }
								    });
								}
							}

							likeControlFixedInBlock('.js-like-control', '.b-article', 20);
						})
						</script>
						<div class="js-like-control" >
							<div class="like-control like-control__self clearfix">
								<div class="position-rel">
									<a href="" class="like-control_ico like-control_ico__like">865</a>
								</div>
								<div class="position-rel">
									<a href="" class="like-control_ico like-control_ico__repost">5</a>
								</div>
								<div class="position-rel">
									<a href="" class="favorites-control_a">123865</a>
								</div>
							</div>
							<div class="article-settings">
								<div class="article-settings_i">
									<a href="" class="article-settings_a article-settings_a__settings active powertip" title="Настройки"></a>
								</div>
								<div class="article-settings_hold display-b">
									<div class="article-settings_i">
										<a href="" class="article-settings_a article-settings_a__pin powertip" title="Прикрепить вверху"></a>
									</div>
									<div class="article-settings_i">
										<a href="" class="article-settings_a article-settings_a__edit powertip"  title="Редактировать"></a>
									</div>
									<div class="article-settings_i">
										<a href="javascript:void(0)" class="ico-users ico-users__friend active powertip" title="Приватность"></a>
										<div class="article-settings_drop display-b">
											<div class="article-settings_drop-i">
												<a href="" class="article-settings_drop-a">
												<span class="ico-users ico-users__all"></span>
												Показывать всем
												</a>
											</div>
											<div class="article-settings_drop-i">
												<a href="" class="article-settings_drop-a">
												<span class="ico-users ico-users__friend"></span>
												Только друзьям
												</a>
											</div>
										</div>
									</div>
									<div class="article-settings_i">
										<a href="" class="article-settings_a article-settings_a__delete powertip"  title="Удалить"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="b-article_cont clearfix">
						<div class="b-article_header clearfix">
							<div class="meta-gray">
								<a href="" class="meta-gray_comment">
									<span class="ico-comment ico-comment__gray"></span>
									<span class="meta-gray_tx">35</span>
								</a>
								<div class="meta-gray_view">
									<span class="ico-view ico-view__gray"></span>
									<span class="meta-gray_tx">305</span>
								</div>
							</div>
							<div class="float-l">
								<a href="" class="b-article_author">Ангелина Богоявленская</a>
								<span class="font-smallest color-gray">Сегодня 13:25</span>
							</div>
						</div>
						<h2 class="b-article_t">
							Самое лучшее утро - просыпаюсь, а ты рядом
						</h2>
						<div class="b-article_in clearfix">
							    <!-- .b-markdown - статья редактора-->
							    <div class="b-markdown"><!--if (vars.type == 'video')--><div class="b-markdown_t-sub">В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции.</div><div class="b-article_in-img"><div class="video-container"><iframe width="600" height="330" src="http://www.youtube.com/embed/IS9xI7Arrsk?wmode=transparent&amp;wmode=transparent&amp;feature=oembed&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe></div></div><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><h2>Загловок H2</h2><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. sdfsdfsdf</p><h3>Загловок H3</h3><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. </p><!--if (vars.type == 'photos')--><!--.b-markdown_t-sub| В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. --><div class="b-article_in-img"><img alt="" src="/lite/images/example/w600-h415.jpg"><a href="#" class="b-markdown_img-water">squarespace</a></div><p>Солончак Уюни — высохшее соленое озеро. Во время сезона дождей солончак покрывается тонким слоем воды и превращается в самую большую в мире зеркальную поверхность. Представьте, что вы будете испытывать, гуляя по этому озеру под ночным звездным небом. </p><h4>Загловок H4</h4><div class="b-article_in-img"><img alt="" src="/lite/images/example/w600-h730-1.jpg"><a href="#" class="b-markdown_img-water">nikon.ru</a></div><div class="b-markdown_description">Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране,</div><p>В Финляндии можно остановиться в настоящем иглу. Только сделано оно из стекла. Но, несмотря на кажущуюся хрупкость строений, внутри иглу тепло и комфортно даже в лютые морозы. А если повезет, вы сможете увидеть настоящее северное сияние, пока наслаждаетесь отдыхом в мягкой кровати. </p><h5>Загловок H5</h5><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><h6>Загловок H6</h6><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><ol><li>Нумерованный списко 1</li><li>Нумерованный списко 2</li><li>Нумерованный списко 3</li><li>Нумерованный списко 4</li></ol><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><ul><li>Маркерованный списко 1</li><li>Маркерованный списко 2</li><li>Маркерованный списко 3</li><li>Маркерованный списко 4</li></ul><p>В половине чашке горячей воды разведем желатин. Дадим ему остыть. Желе для торта разводим согласно инструкции. Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране, все же Роберт Паттинсон и Кристен Стюарт расстались и пока решили взять паузу в своих отношениях.</p><div class="b-markdown_description">Поломаем не небольшие кусочки крекер. Апельсин почистим и разберем на дольки. а не только лишь на экране,</div></div>
							    <!-- <div class="b-markdown"><p>Ценник этих свадебных торжеств начинается от 8 миллионов долларов. Что организуют за эти деньги? Представляем вам 5 самых роскошных свадеб последних лет. </p>  <h3>Ваниша Миттал и Амит Бхатиа, 2005 год</h3><p>Ваниша Миттал (дочь индийского магната) - одна из самых завидных невест того времени. Ее приданое исчислялось миллиардами долларов. В 2004 году отец Ваниши Лакшми Миттал благословил ее на брак с банкиром Амит Бхатиа. </p>  <div class="b-article_in-img b-markdown_img-hold"><img alt="" src="http://img.happy-giraffe.ru/v2/thumbs/postImage/b9/86/5c7f40c7cc133dba27bf019553cb.jpg"><a href="/site/out/?url=http://www.forbes.ru" class="b-markdown_img-water" rel="nofollow" target="_blank">forbes</a></div>      <p><strong>Стоимость свадьбы</strong>: 60 миллионов долларов.</p>  <p><strong>Количество гостей</strong>: около 1000 </p>  <p><strong>Место</strong>: Париж  </p>  <p><strong>Фишки свадьбы</strong>: приглашения гости получили в отлитых из серебра шкатулках. Свадьба длилась неделю. Грандиозный салют, живое выступление Кайли Миноуг, прогулки по красивейшему парку Тюильри (в эти дни он был закрыт для обычных посетителей). На торжестве было съедено несколько десятков килограммов икры и выпито более 5000 бутылок вина Château Mouton-Rothschild (цена от 50 000 рублей за бутылку).  </p>  <h3>Принц Уильям и Кейт Миддлтон, 2011 год</h3><p>День свадьбы принца Ульяма и его подруги по Сент-Эндрюсскому университету был объявлен государственными праздником. За церемонией бракосочетания пары следил весь мир. </p>  <div class="b-article_in-img b-markdown_img-hold"><img alt="" src="http://img.happy-giraffe.ru/v2/thumbs/postImage/df/c9/105c5634b606b6b67e0dbd65607b.jpg"><a href="/site/out/?url=http://ic.pics.livejournal.com" class="b-markdown_img-water" rel="nofollow" target="_blank">livejournal</a></div>    <p><strong>Стоимость свадьбы</strong> : 34 миллиона долларов</p>  <p><strong>Количество гостей:</strong> около 2000 </p>  <p><strong>Место:</strong> Лондон </p>  <p><strong>Фишки свадьбы:</strong> В торжестве использовались королевский гараж, пешая и конная гвардии. На одну только охрану было потрачено 32 миллиона австралийских долларов, а на цветы - 800 000. Многие жители Великобритании были недовольны тем, что торжество частично оплачивалось из государственного бюджета при условии непростой экономической ситуации. </p>  <h3>Андрей Мельниченко и Александра Николич, 2005 год</h3><p>Российский предприниматель Андрей Мельниченко, являющийся завсегдатаем списка Forbes, связал свою жизнь с Александрой Николич - “Мисс Югославия”.<br></p><div class="b-article_in-img b-markdown_img-hold"><img alt="" src="http://img.happy-giraffe.ru/v2/thumbs/postImage/f8/3f/cc2123fb8ba96ea0da18ec056252.jpg"><a href="/site/out/?url=http://www.forbes.ru" class="b-markdown_img-water" rel="nofollow" target="_blank">forbes</a></div>    <p><strong>Стоимость свадьбы:</strong> 34 миллионов долларов. </p>  <p><strong>Количество гостей:</strong> 250  </p>  <p><strong>Место:</strong> город Антиб, Лазурный берег </p>  <p><strong>Фишки свадьбы:</strong> Церемония венчания проходила в специально доставленной из Подмосковья часовне (выбор невесты). Гости наслаждались музыкальным сопровождением свадьбы от Кристины Агилеры и Уитни Хьюстон, которые получили по 3, 5 миллиона долларов за присутствие на торжестве. К их компании присоединились Хулио и Энрике Иглесиас. А угощение гостям подготовил один из лучших поваров мира француз Ален Дюкасс.  \</p>  <h3>Ким Кардашьян и Крис Хамфрис, 2011 год</h3><p>Имя светской львицы прочно ассоциируется с роскошью. Когда на предложении руки и сердца возлюбленный Ким Крис Хамфрис подарил ей кольцо с бриллиантом в 20, 5 карат и стоимостью почти 2 миллиона долларов, весь бомонд гадал, насколько шикарной будет свадьба.<br></p><div class="b-article_in-img b-markdown_img-hold"><img alt="" src="http://img.happy-giraffe.ru/v2/thumbs/postImage/55/aa/5aea026b7ff9bddb5bad71236cc2.jpg"><a href="/site/out/?url=http://limebridge.ru" class="b-markdown_img-water" rel="nofollow" target="_blank">limebridge</a></div>    <p><strong>Стоимость свадьбы:</strong> 10 миллионов долларов </p>  <p><strong>Количество гостей:</strong>450 </p>  <p><strong>Место:</strong> поместье в Монтесито, штат Калифорния </p>  <p><strong>Фишки свадьбы:</strong> Строгий дресс-код: только черные или белые наряды. Свадьбы проходила в шатре, украшенном изнутри тысячами роз, помещенных в дорогие хрустальные вазы Baccarat. По некоторым данным, свадьба принесла супругам 18 миллионов долларов.  </p>  <h3>Уэйн Руни и Колин МакЛафлин, 2008 год</h3><p>Нападающий команды «Манчестер Юнайтед» вопреки расхожим мнениям о футболистах, взял в жены подругу детства, с которой был знаком еще со школы. </p>  <div class="b-article_in-img b-markdown_img-hold"><img alt="" src="http://img.happy-giraffe.ru/v2/thumbs/postImage/0a/2a/274c64dcfe3ff9c5407b2adaac88.jpg"><a href="/site/out/?url=http://www.spletnik.ru" class="b-markdown_img-water" rel="nofollow" target="_blank">spletnik</a></div>    <p><strong>Стоимость свадьбы:</strong> 8 миллионов долларов </p>  <p><strong>Количество гостей:</strong>100 </p>  <p><strong>Место:</strong> Итальянская Ривьера </p>  <p><strong>Фишки свадьбы:</strong> Скромная 20-минутная церемония. Празднование проходило на трех яхтах. Каждый присутствующий получил по коробочке с живой бабочкой, которые одновременно были выпущены в воздух. Вместо подарков молодожены предложили гостям перевести деньги на счет благотворительной организации. На свадьбе выступала группа Westlife. Свадебное платье невесты - 200 тысяч фунтов. Все затраченные на свадьбу деньги супруги вернули, подписав контракт с журналом ОК! на 2,5 млн фунтов. </p>  <p><em>источник: ReDevils.ru, forbes.ru wikipedia </em></p>  </div> -->
						</div>
						
						<div class="custom-likes-b">
							<div class="custom-likes-b_slogan">Поделитесь с друзьями!</div>
						
							<div class="like-block fast-like-block" style="font-size: 11px;">
								<script type="text/javascript" src="//yandex.st/share/share.js"
									charset="utf-8"></script>
								<div class="yashare-auto-init" data-yashareL10n="ru"
								 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter" data-yashareType="small"

								></div> 	
				
							</div>
						</div>
												
					</div>
				</div>
				<div class="b-banners b-banners__wide">
                    <img class="display-b" alt="" src="/images/example/yandex-direct_wide.jpg">
                </div>

                <div class="comments-gray comments-gray__wide">
                    <div class="comments-gray_t">
                        <span class="comments-gray_t-a-tx">Все комментарии (28)</span>
                        <a href="" class="btn-green">Добавить</a>
                    </div>
                    <div class="comments-gray_hold">
                        <div class="comments-gray_i comments-gray_i__self">
                            <div class="comments-gray_ava">
                                <a href="" class="ava small male"></a>
                            </div>
                            <div class="comments-gray_frame">
                                <div class="comments-gray_header clearfix">
                                    <a href="" class="comments-gray_author">Ангелина Богоявленская </a>
                                    <span class="font-smallest color-gray">Сегодня 13:25</span>
                                </div>
                                <div class="comments-gray_cont wysiwyg-content">
                                    <p> Мне безумно жалко всех женщин, но особенно Тину Кароль, я просто представить себе не могу <a href="">как она все это переживет</a> как она все это переживет(</p>
                                    <p>я не нашел, где можно поменять название трека. Меняя название трека в альбоме он автоматически производит поиск по сайту и подцепляет естественно студийные версии песен вместо нужных.  я не нашел, где можно поменять название трека. Меняя название трека в альбоме он автоматически </p>
                                </div>
                            </div>
                            <div class="comments-gray_control comments-gray_control__self">
                                <div class="comments-gray_control-hold">
                                    <div class="clearfix">
                                        <a href="" class="message-ico message-ico__edit powertip" title="Редактировать"></a>
                                    </div>
                                    <div class="clearfix">
                                        <a href="" class="message-ico message-ico__del powertip" title="Удалить"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="comments-gray_i comments-gray_i__recovery">
                            <div class="comments-gray_ava">
                                <a href="" class="ava small female"></a>
                            </div>
                            <div class="comments-gray_frame">
                                <div class="comments-gray_header clearfix">
                                    <a href="" class="comments-gray_author">Анг Богоявлен </a>
                                    <span class="font-smallest color-gray">Сегодня 14:25</span>
                                </div>
                                <div class="comments-gray_cont wysiwyg-content">
                                    <p>Комментарий успешно удален.<a href="" class="comments-gray_a-recovery">Восстановить?</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comments-gray_add clearfix">
                        
                        <div class="comments-gray_ava">
                            <a href="" class="ava small female"></a>
                        </div>
                        <div class="comments-gray_frame">
                            <input type="text" name="" id="" class="comments-gray_add-itx itx-gray" placeholder="Ваш комментарий">
                        </div>
                    </div>
                </div>

				<div class="such-post">
					<div class="such-post_title">Смотрите также</div>
					<div class="clearfix">
						<div class="such-post_i such-post_i__photopost">
							<a href="" class="such-post_img-hold">
								<img src="/images/example/w335-h230.jpg" alt="" class="such-post_img">
								<span class="such-post_img-overlay"></span>
								<span class="such-post_tip">25 фото</span>
							</a>
							<div class="such-post_type-hold">
								<div class="such-post_type such-post_type__photopost"></div>
							</div>
							<div class="such-post_cont">
								<div class="clearfix">
									<div class="meta-gray">
										<a class="meta-gray_comment" href="">
											<span class="ico-comment ico-comment__white"></span>
											<span class="meta-gray_tx color-gray-light">35</span>
										</a>
										<div class="meta-gray_view">
											<span class="ico-view ico-view__white"></span>
											<span class="meta-gray_tx color-gray-light">305</span>
										</div>
									</div>
									<div class="such-post_author">
										<a href="" class="ava female middle">
											<span class="icon-status status-online"></span>
											<img src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg" alt="">
										</a>
										<a href="" class="such-post_author-name">Татьяна</a>
										<div class="such-post_date">Сегодня 13:25</div>
									</div>
									
								</div>
								<a href="" class="such-post_t">Креативная сервисная</a>
							</div>
						</div>
						<div class="such-post_i">
							<a href="" class="such-post_img-hold">
								<img src="/images/example/w335-h230.jpg" alt="" class="such-post_img">
							</a>
							<div class="such-post_type-hold">
								<div class="such-post_type such-post_type__post"></div>
							</div>
							<div class="such-post_cont">
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
									<div class="such-post_author">
										<a href="" class="ava female middle">
											<span class="icon-status status-online"></span>
											<img src="http://img.happy-giraffe.ru/avatars/12963/ava/8d26a6f4dbae0536f8dbec37c0b5e5f8.jpg" alt="">
										</a>
										<a href="" class="such-post_author-name">ТатьянаАлександровна</a>
										<div class="such-post_date">Сегодня 13:25</div>
									</div>
									
								</div>
								<a href="" class="such-post_t">Готовим  Торт Сметанник в домашних условиях</a>
							</div>
						</div>
					</div>
				</div>

				<div class="menu-simple menu-simple__after-article2">
					<div class="menu-simple_t-sub">Вам может быть интересно</div>
					<ul class="menu-simple_ul">
						<li class="menu-simple_li">
							<a class="menu-simple_a" href="">Как правильно встречать мужа с работы</a>
						</li>
						<li class="menu-simple_li">
							<a class="menu-simple_a" href="">Детские передачи</a>
						</li>
						<li class="menu-simple_li">
							<a class="menu-simple_a" href="">Рутина отношений убивает супружество</a>
						</li>
					</ul>
				</div>

				<table class="article-nearby clearfix" ellpadding="0" cellspacing="0">
					<tr>
						<td>
							<div class="article-nearby_hint">Предыдущая запись</div>
						</td>
						<td class="article-nearby_r">
							<div class="article-nearby_hint">Следующая запись</div>
						</td>
					</tr>
					<tr>
						<td>
							<a href="" class="article-nearby_a clearfix">
								<span class="article-nearby_img-hold">
									<img src="/images/example/w64-h61-2.jpg" alt="">
								</span>
								<span class="article-nearby_tx">Как приготовить Монастыпскую избу</span>
							</a>
						</td>
						<td class="article-nearby_r">
							<a href="" class="article-nearby_a clearfix">
								<span class="article-nearby_tx">Готовим  Торт Сметанник в домашних условиях</span>
							</a>
						</td>
					</tr>
				</table>

			</div>
			
			<div class="col-1">
				<div class="readers2">
					<a href="" class="btn-green btn-medium">Подписаться</a>
					<ul class="readers2_ul clearfix">
						<li class="readers2_li clearfix">
							<a href="" class="ava female small">
								<span class="icon-status status-online"></span>
								<img alt="" src="http://img.happy-giraffe.ru/avatars/34531/small/2fd2c2d5e773c3cb8a36ce231fbc6ce0.JPG">
							</a>
						</li>
						<li class="readers2_li clearfix">
							<a href="" class="ava female small">
								<img alt="" src="http://img.happy-giraffe.ru/avatars/34531/small/2fd2c2d5e773c3cb8a36ce231fbc6ce0.JPG">
							</a>
						</li>
						<li class="readers2_li clearfix">
							<a href="" class="ava female small">
								<span class="icon-status status-online"></span>
								<img alt="" src="http://img.happy-giraffe.ru/avatars/34531/small/2fd2c2d5e773c3cb8a36ce231fbc6ce0.JPG">
							</a>
						</li>
						<li class="readers2_li clearfix">
							<a href="" class="ava female small">
							</a>
						</li>
						<li class="readers2_li clearfix">
							<a href="" class="ava female small">
								<span class="icon-status status-online"></span>
								<img alt="" src="http://img.happy-giraffe.ru/avatars/34531/small/2fd2c2d5e773c3cb8a36ce231fbc6ce0.JPG">
							</a>
						</li>
						<li class="readers2_li clearfix">
							<a href="" class="ava male small">
								<span class="icon-status status-online"></span>
							</a>
						</li>
					</ul>
					<div class="clearfix">
						<div class="readers2_count">Все подписчики (129)</div>
					</div>
				</div>
				
				<div class="menu-simple">
					<ul class="menu-simple_ul">
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Обо всем</a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Свадьба - прекрасный миг</a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Прикольное видео </a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Школа восточного танца  </a>
						</li>
						<li class="menu-simple_li active">
							<a href="" class="menu-simple_a">Мой мужчина </a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Детские передачи </a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Свадьбы </a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Кормление ребенка </a>
						</li>
						<li class="menu-simple_li">
							<a href="" class="menu-simple_a">Воспитание детей </a>
						</li>
					</ul>
				</div>
				
				<div class="fast-articles2 js-fast-articles2">
					<div class="fast-articles2_t-ico"></div>
					<div class="fast-articles2_t">Популярные записи</div>
					<div class="fast-articles2_i">
						<div class="fast-articles2_header clearfix">
						
							<div class="meta-gray">
								<a href="" class="meta-gray_comment">
									<span class="ico-comment ico-comment__gray"></span>
									<span class="meta-gray_tx">35</span>
								</a>
								<div class="meta-gray_view">
									<span class="ico-view ico-view__gray"></span>
									<span class="meta-gray_tx">305</span>
								</div>
							</div>
							
							<div class="float-l">
								<a href="" class="fast-articles2_author">
									<span class="ico-status ico-status__offline"></span>
									<span class="fast-articles2_author-tx">Татьяна</span>
								</a>
							</div>
						</div>
						<div class="fast-articles2_i-t">
							<a href="" class="fast-articles2_i-t-a"> О моем первом бойфренде</a>
						</div>
						<div class="fast-articles2_i-desc">Практически нет девушки, которая не переживала </div>
						<div class="fast-articles2_i-img-hold">
							<a href=""><img src="/images/example/w220-h164-1.jpg" alt="" class="fast-articles2_i-img"></a>
						</div>
					</div>
					<div class="fast-articles2_i">
						<div class="fast-articles2_header clearfix">
						
							<div class="meta-gray">
								<a href="" class="meta-gray_comment">
									<span class="ico-comment ico-comment__gray"></span>
									<span class="meta-gray_tx">35</span>
								</a>
								<div class="meta-gray_view">
									<span class="ico-view ico-view__gray"></span>
									<span class="meta-gray_tx">305</span>
								</div>
							</div>
							
							<div class="float-l">
								<a href="" class="fast-articles2_author">
									<span class="ico-status ico-status__online"></span>
									<span class="fast-articles2_author-tx">Татьяна</span>
								</a>
							</div>
						</div>
						<div class="fast-articles2_i-t">
							<a href="" class="fast-articles2_i-t-a"> Как мне предлагали руку и сердце</a>
						</div>
						<div class="fast-articles2_i-desc">Практически нет девушки, которая не переживала </div>
						<div class="fast-articles2_i-img-hold">
							<a href=""><img src="/images/example/w220-h165-1.jpg" alt="" class="fast-articles2_i-img"></a>
						</div>
					</div>
				</div>
				
				<div class="fast-articles3">
					<div class="fast-articles3_i">
						<a href="#" class="fast-articles3_a">
							<span class="fast-articles3_img-hold">
								<img src="/images/banners/post-157877.jpg" class="fast-articles3_img" alt="">
							</span>
							<span class="fast-articles3_tx">Какое животное лучше завести для ребенка</span>
						</a>
					</div>
					<div class="fast-articles3_i">
						<a href="#" class="fast-articles3_a">
							<span class="fast-articles3_img-hold">
								<img src="/images/banners/post-90345.jpg" class="fast-articles3_img" alt="">
							</span>
							<span class="fast-articles3_tx">7 способов заново влюбиться в собственного мужа</span>
						</a>
					</div>
					<div class="fast-articles3_i">
						<a href="#" class="fast-articles3_a">
							<span class="fast-articles3_img-hold">
								<img src="/images/banners/post-204717.jpg" class="fast-articles3_img" alt="">
							</span>
							<span class="fast-articles3_tx">Научите ребенка правильно умываться</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		</div>
		
		<a href="#layout" id="btn-up-page"></a>
		<div class="footer-push"></div>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/footer.php'; ?>
</div>

</body>
</html>