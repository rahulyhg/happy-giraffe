﻿<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=""> <!--<![endif]-->
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/head.php'; ?>
</head>
<body class="body-gray">
	
<div class="layout-container">
	<div class="layout-wrapper">
	
		<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/header-new.php'; ?>
		
		<div class="layout-content margin-l0 clearfix">
			<div class="content-cols ">
				<div class="col-white">
					<div id="contest" class="contest contest-11">
						
						<div class="section-banner">
							<!-- .button-holder - в этом конкурсе не используется -->
							<div class="button-holder">
								<!-- <a href=""class="contest-button">Участвовать!</a> -->
								<div class="contest-error-hint" style="display:none;">
									<h4>Oops!</h4><p>Что бы проголосовать, вам нужно пройти <a href='#'>Первые 6 шагов</a> в свой анкете </p>
								</div>
							</div>
							<img src="/images/contest/banner-w1000-11.jpg" />
						</div>

						<div class="contest-nav clearfix">
							<ul>
								<li class="active"><a href="">О конкурсе</a></li>
								<li><a href="">Правила</a></li>
								<li><a href="">Призы</a></li>
								<li><a href="">Участники</a></li>
							</ul>
						</div>
						
						<div class="contest-sponsor">
							<a href="http://www.neopod.ru"><img src="/images/contest/contest-sponsor-11-4.jpg" alt="" class="contest-sponsor_img"></a>
							<a href="http://www.neopod.ru/brands/neotrike/"><img src="/images/contest/contest-sponsor-11-5.jpg" alt="" class="contest-sponsor_img"></a>
							
						</div>
					
						<!-- id="takeapartPhotoContest"  -->
						<div class="contest-get">
							
							<div class="heading-title clearfix">Я хочу участвовать в фотоконкурсе</div>				
				
							<form>

								<div class="margin-b30 clearfix">
									<input type="text" name="" id="" class="itx-simple w-100p" placeholder="Название фото">
								</div>
								<div class="margin-b30">
									<div class="b-add-img b-add-img__for-single">
										<div class="b-add-img_hold">
											<div class="b-add-img_t">
												Загрузите фотографию с компьютера
												<div class="b-add-img_t-tx">Поддерживаемые форматы: jpg и png</div>
											</div>
											<div class="file-fake">
												<button class="btn-green btn-medium file-fake_btn">Обзор</button>
												<input type="file" name="">
											</div>
										</div>
										<!-- <div class="textalign-c clearfix">
											<div class="b-add-img_i b-add-img_i__single">
												<img class="b-add-img_i-img" src="/images/example/w440-h340.jpg" alt="">
												<div class="b-add-img_i-vert"></div>
												<div class="b-add-img_i-overlay">
													<a href="" class="b-add-img_i-del ico-close4"></a>
												</div>
											</div>
										</div> -->
										<!-- Текст приглашения для перетаскивания можно скрыть или удалить при наличии фото -->
										<div class="b-add-img_html5-tx">или перетащите фото сюда</div>
									</div>
								</div>
								<div class="margin-b40 clearfix">
									<div class="float-r">
										<a class="btn-green btn-h46" >Участвовать</a>
									</div>
									<div class="float-l margin-t10">
										<a class="a-checkbox active" href=""></a>
										Я согласен с 
										<a href="" >Правилами конкурса</a> 
									</div>
								</div>
							</form>
							
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
		
		<div class="footer-push"></div>
	
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/footer.php'; ?>
</div>

</body>
</html>