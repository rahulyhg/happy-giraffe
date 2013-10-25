﻿<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=""> <!--<![endif]-->
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/head.php'; ?>
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,100&amp;subset=latin,cyrillic-ext,cyrillic">

</head>
<body class="body-gray">
	
<div class="layout-container">
	<div class="layout-wrapper">
		<div class="layout-header layout-header__nologin clearfix">
			<div class="content-cols clearfix">
				<div class="col-1">
					<h1 class="logo">
						<a href="/" class="logo_i" title="Веселый жираф - сайт для все семьи">Веселый жираф - сайт для все семьи</a>
						<strong class="logo_slogan">САЙТ ДЛЯ ВСЕЙ СЕМЬИ</strong>
					</h1>
					<div class="sidebar-search clearfix">
						<input type="text" placeholder="Поиск по сайту" class="sidebar-search_itx" id="" name="">
						<!-- 
						В начале ввода текста, скрыть sidebar-search_btn добавить класс active"
						 -->
						<button class="sidebar-search_btn"></button>
					</div>
				</div>
				<div class="col-23">
					<div class="b-join clearfix">
						<div class="b-join_left">
							<div class="b-join_tx"> Более <span class="b-join_tx-big"> 20 000 000</span> мам и пап</div>
							<div class="b-join_slogan">уже посетили Веселый Жираф!</div>
						</div>
						<div class="b-join_right">
							<a href="" class="btn-green btn-big">Присоединяйтесь!</a>
							<div class="clearfix">
								<a href="" class="display-ib verticalalign-m">Войти</a>
								<span class="i-or">или</span>
								<ul class="display-ib verticalalign-m">
									<li class="display-ib">
										<a class="custom-like" href="">
											<span class="custom-like_icon odnoklassniki"></span>
										</a>
									</li>
									<li class="display-ib">
										<a class="custom-like" href="">
											<span class="custom-like_icon vkontakte"></span>
										</a>
									</li>
									<li class="display-ib">
										<a class="custom-like" href="">
											<span class="custom-like_icon facebook"></span>
										</a>
									</li>
									<li class="display-ib">
										<a class="custom-like" href="">
											<span class="custom-like_icon twitter"></span>
										</a>
									</li>
								</ul>
								
							
								
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
			$(window).load(function() {
				/*
				block - элемент, что фиксируется
				elementStop - до какого элемента фиксируется
				blockIndent - отступ
				*/
				function bJoinRowFixed() {

					var block = $('.js-b-join-row');
					var blockTop = block.offset().top;

					var startTop = $('.layout-header').height();
					

					$(window).scroll(function() {
				        var windowScrollTop = $(window).scrollTop();
				        if (windowScrollTop > startTop) {
				        	block.fadeIn();
				        } else {

							block.fadeOut();

				        }
				    });
				}

				bJoinRowFixed('.js-b-join-row');
			})
			</script>
			<div class="b-join-row js-b-join-row">
				<div class="b-join-row_hold">
					<div class="b-join-row_logo"></div>
					<div class="b-join-row_tx">Более <span class="b-join-row_tx-big"> 20 000 000</span> мам и пап</div>
					<div class="b-join-row_slogan">уже посетили Веселый Жираф!</div>
					<a href="" class="btn-green btn-h46">Присоединяйтесь!</a>
				</div>
			</div>


		</div>


		<div class="layout-content clearfix">
			<div class="content-cols padding-t20">
				<div class="col-1"> 
					<ul class="menu-list menu-list__favorites margin-t10">
						<li class="menu-list_li">
							<a href="" class="menu-list_i">
								<span class="menu-list_tx">О проекте</span>
							</a>
						</li>
						<li class="menu-list_li">
							<a href="" class="menu-list_i">
								<span class="menu-list_tx">Правила</span>
							</a>
						</li>
						<li class="menu-list_li">
							<a href="" class="menu-list_i">
								<span class="menu-list_tx">Задать вопрос</span>
							</a>
						</li>
						<li class="menu-list_li">
							<a href="" class="menu-list_i active">
								<span class="menu-list_tx">Реклама на сайте</span>
							</a>
						</li>
						<li class="menu-list_li">
							<span href="" class="menu-list_i disabled">
								<span class="menu-list_tx">Контакты </span>
							</span>
						</li>
					</ul>
				</div>
				<div class="col-23-middle">
					<div class="col-white-hoar">
						<h1 class="heading-title margin-t20 clearfix">Реклама на сайте</h1>
						<div class="margin-20 padding-b20">
							<div class="wysiwyg-content">
								<p>Cистема безопасности передачи данных обеспечивается использованием протокола Secure Sockets Layer (SSL). Дальнейшая передача информации осуществляется по закрытым банковским сетям, имеющим высшую степень защиты. Сбор и обработка полученных конфиденциальных данных клиента (реквизиты карты, регистрационные данные и т.д.) производится в процессинговом центре. Таким образом, ЗАО "ПФ "СКБ Контур" не может получить персональные данные покупателя, данные банковской карты.</p>
								<p>Повышенная защита платежей может обеспечиваться 3D Secure - технологией, которая является дополнительным уровнем безопасности платежей для онлайн-кредитных и дебетных карт. В случае, если карта поддерживает технологию 3D Secure, в процессе авторизации будет запрошен дополнительный одноразовый пароль, способ получения которого зависит от банка. Ниже приведены способы получения пароля для некоторых банков. Уточнить информацию можно в банке, выпустившем карту.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  	
		
		<div class="footer-push"></div>
		
	</div>

</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/footer.php'; ?>

</body>
</html>
