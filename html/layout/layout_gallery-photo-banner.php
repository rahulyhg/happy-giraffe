﻿<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=""> <!--<![endif]-->
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/head.php'; ?>
	<script>
	
		$(function(){
			
			userDialogsCalc(); // append
			
		})
		
		$(window).bind('resize', function(){
		
			userDialogsCalc();
			
		})
		
		function userDialogsCalc(){
			
			var box = $('#user-dialogs');
			
			var windowH = $(window).height();
			var headerH = 90;
			var textareaH = 100;
			var wannachatH = 140;
			var userH = 110;
			var marginH = 30;
			
			var hasWannachat = box.hasClass('has-wannachat') ? 1 : 0;
			
			var generalH = windowH - marginH*2 - headerH;
			if (generalH < 400) generalH = 400;
			
			box.find('.contacts').height(generalH);
			box.find('.dialog').height(generalH);
			
			box.find('.contacts .list').height(generalH - wannachatH*hasWannachat);
			box.find('.dialog .dialog-messages').height(generalH - textareaH - userH);
						
		}
		
	</script>

</head>
<body class="body-club" style="overflow:hidden;">

	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/top-line-menu.php'; ?>
	
	<div class="layout-container">
		<div class="layout-wrapper">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/layout-header.php'; ?>
			
			<div id="content" class="clearfix">
				
				<div class="default-comments">
					
					<div class="comments-meta clearfix">
						<a href="" class="btn btn-orange a-right"><span><span>Добавить комментарий</span></span></a>
						<div class="title">Комментарии</div>
						<div class="count">55</div>
					</div>
					
					<ul>
						<li class="author-comment">
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<a href="" class="add-friend"><span class="tip">Пригласить в друзья</span></a>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">1</span>
										<span class="date">Сегодня, 20:45</span>
									</div>
									<div class="content-in">
										<div class="wysiwyg-content">
											<h2>Как выбрать детскую коляску</h2>
							
											<p>Как правило, кроватку новорожденному приобретают незадолго до его появления на свет. При этом многие молодые <b>родители</b> обращают внимание главным <u>образом</u> на ее <strike>внешний</strike> вид. Но, прельстившись яркими красками, многие платят баснословные суммы, даже не поинтересовавшись, из чего сделано это покорившее вас чудо.</p>
											
											<p><img src="/images/example/12.jpg" width="300" class="content-img"><i>Атопический дерматит у детей до года локализуется в основном на щечках и ягодицах, реже на теле и конечностях, на коже головы возможно появление корочек. Когда малышу исполнится год, то места высыпаний меняются – теперь поражаются локтевые сгибы (внутри и снаружи), подколенные впадины, шея. После трех лет высыпания начинают поражать также и кисти рук.</i></p>
											
											<h3>Как выбрать детскую коляску</h3>
											
											<ul>
												<li>Приходишь в детский магазин - глаза разбегаются: столько всего, что порой забываешь, зачем пришел. <a href="">Немало и разновидностей детских кроваток</a>: тут и люльки для младенцев</li>
												<li>И кроватки-"домики" - с навесом в виде крыши, и кровати в стиле "евростандарт" - выкрашенные в белый цвет, и даже претендующие на готический стиль, </li>
												<li>Есть и продукция попроще. Не покупайте ничего под влиянием первых эмоций. </li>
											</ul>
											
											<h3>Как выбрать детскую коляску</h3>
											
											<ol>
												<li>Приходишь в детский магазин - глаза разбегаются: столько всего, что порой забываешь, зачем пришел. <a href="">Немало и разновидностей детских кроваток</a>: тут и люльки для младенцев</li>
												<li>И кроватки-"домики" - с навесом в виде крыши, и кровати в стиле "евростандарт" - выкрашенные в белый цвет, и даже претендующие на готический стиль, </li>
												<li>Есть и продукция попроще. Не покупайте ничего под влиянием первых эмоций. </li>
											</ol>
										</div>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<a href="" class="add-friend"><span class="tip">Пригласить в друзья</span></a>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">2</span>
										<span class="date">Сегодня, 20:45</span>
									</div>
									<div class="content-in">
										<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :)</p>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<span class="friend">друг</span>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">3</span>
										<span class="date">Сегодня, 20:45</span>
										<div class="answer">
											Ответ для
											<div class="user-info clearfix">
												<a onclick="return false;" class="ava female small" href="#">
													<img src="http://www.happy-giraffe.ru/upload/avatars/small/120316-10264-ya.jpg" alt="">
												</a>
											</div>
											на <span class="num"><a href="#">2</a></span>
										</div>
									</div>
									<div class="content-in">
										<div class="quote">
											<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :)</p>
										</div>
										<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :) <a href="#photo-content">Якорь на контент</a></p>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						
					</ul>
					
				</div>
			</div>  	
			
		
		<div class="footer-push"></div>
		
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/footer.php'; ?>
	</div>
	
	<div id="photo-window-bg" style="display:block;"></div>
	
	<div id="photo-window">
		
		<div id="photo-window-in" style="left:8px;">
			
			<div class="photo-bg" >
				
				<div class="top-line clearfix">
					
					<a href="javascript:void(0);" class="close" onclick="closePhoto();"></a>
					
					<div class="user">
						<div class="user-info clearfix">
							<a class="ava female small">
								<span class="icon-status"></span>
							</a>
							<div class="details">
								<a href="" class="username">Александр Богоявленский</a>
							</div>
						</div>
					</div>
					<div class="photo-info">
						<div class="favorites-control">
							<a class="favorites-control_a powertip" href="" title="В избранное">
								9145
							</a>
						</div>
						Альбом  «Оформление вторые блюда» - <span class="count">3 фото из 158</span>
						<div class="title">Жареный картофель с беконом</div>
					</div>
					
				</div>
				
			<div class="content-cols clearfix">
				<div class="col-12 photo-banner-hold ">
			
				<div id="photo">
					
					<div class="img">
						<table><tr><td>
							<img src="http://img.happy-giraffe.ru/thumbs/960x627/112202/66c705439ec058b27656938e5b18561b.JPG" />
						</td></tr></table>
					</div>
					
					<a href="" class="prev"><i class="icon"></i>предыдушая</a>
					<a href="" class="next"><i class="icon"></i>следующая</a>
					
				</div>
				
				</div>
				
				<div class="col-3">
					<div class="margin-t60">
						<a href=""><img src="/images/contest/banner-w240-10.jpg" alt=""></a>
					</div>
				</div>	
			</div>
			
				<div class="photo-comment">
					<p>Квашеная капуста с клюквой, грибами, соусом, зеленью квашеная квашеная капуста с клюквой, грибами, капуста соусом, зеленью квашеная, Квашеная капуста с клюквой, грибами, соусом, зеленью квашеная квашеная</p>
				</div>
				
			</div>
	
			<div id="photo-content">
				
				<div class="default-comments">
					
					<div class="comments-meta clearfix">
						<a href="" class="btn btn-orange a-right"><span><span>Добавить комментарий</span></span></a>
						<div class="title">Комментарии</div>
						<div class="count">55</div>
					</div>
					
					<ul>
						<li class="author-comment">
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<a href="" class="add-friend"><span class="tip">Пригласить в друзья</span></a>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">1</span>
										<span class="date">Сегодня, 20:45</span>
									</div>
									<div class="content-in">
										<div class="wysiwyg-content">
											<h2>Как выбрать детскую коляску</h2>
							
											<p>Как правило, кроватку новорожденному приобретают незадолго до его появления на свет. При этом многие молодые <b>родители</b> обращают внимание главным <u>образом</u> на ее <strike>внешний</strike> вид. Но, прельстившись яркими красками, многие платят баснословные суммы, даже не поинтересовавшись, из чего сделано это покорившее вас чудо.</p>
											
											<p><img src="/images/example/12.jpg" width="300" class="content-img"><i>Атопический дерматит у детей до года локализуется в основном на щечках и ягодицах, реже на теле и конечностях, на коже головы возможно появление корочек. Когда малышу исполнится год, то места высыпаний меняются – теперь поражаются локтевые сгибы (внутри и снаружи), подколенные впадины, шея. После трех лет высыпания начинают поражать также и кисти рук.</i></p>
											
											<h3>Как выбрать детскую коляску</h3>
											
											<ul>
												<li>Приходишь в детский магазин - глаза разбегаются: столько всего, что порой забываешь, зачем пришел. <a href="">Немало и разновидностей детских кроваток</a>: тут и люльки для младенцев</li>
												<li>И кроватки-"домики" - с навесом в виде крыши, и кровати в стиле "евростандарт" - выкрашенные в белый цвет, и даже претендующие на готический стиль, </li>
												<li>Есть и продукция попроще. Не покупайте ничего под влиянием первых эмоций. </li>
											</ul>
											
											<h3>Как выбрать детскую коляску</h3>
											
											<ol>
												<li>Приходишь в детский магазин - глаза разбегаются: столько всего, что порой забываешь, зачем пришел. <a href="">Немало и разновидностей детских кроваток</a>: тут и люльки для младенцев</li>
												<li>И кроватки-"домики" - с навесом в виде крыши, и кровати в стиле "евростандарт" - выкрашенные в белый цвет, и даже претендующие на готический стиль, </li>
												<li>Есть и продукция попроще. Не покупайте ничего под влиянием первых эмоций. </li>
											</ol>
										</div>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<a href="" class="add-friend"><span class="tip">Пригласить в друзья</span></a>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">2</span>
										<span class="date">Сегодня, 20:45</span>
									</div>
									<div class="content-in">
										<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :)</p>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="comment-in clearfix">
								<div class="header clearfix">
									<div class="user-info clearfix">
										<div class="ava female"></div>
										<div class="details">
											<span class="icon-status status-online"></span>
											<a href="" class="username">Дарья</a>
											<div class="user-fast-buttons clearfix">
												<span class="friend">друг</span>
												<a href="" class="new-message"><span class="tip">Написать сообщение</span></a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="content">
									<div class="meta">
										<span class="num">3</span>
										<span class="date">Сегодня, 20:45</span>
										<div class="answer">
											Ответ для
											<div class="user-info clearfix">
												<a onclick="return false;" class="ava female small" href="#">
													<img src="http://www.happy-giraffe.ru/upload/avatars/small/120316-10264-ya.jpg" alt="">
												</a>
											</div>
											на <span class="num"><a href="#">2</a></span>
										</div>
									</div>
									<div class="content-in">
										<div class="quote">
											<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :)</p>
										</div>
										<p>Коляска просто супер!!! Очень удобная и функциональная. Ни разу не пожалели, что купили именно эту коляску. Это маленький вездеход :) <a href="#photo-content">Якорь на контент</a></p>
									</div>
									<div class="actions">
										<a href="" class="claim">Нарушение!</a>
										<div class="admin-actions">
											<a href="" class="edit"><i class="icon"></i></a>
											<a href="#deleteComment" class="remove fancy"><i class="icon"></i></a>
										</div>
										<a href="">Ответить</a>
										&nbsp;
										<a href="" class="quote-link">С цитатой</a>
									</div>
								</div>
							</div>
						</li>
						
					</ul>
					
				</div>
				
				<div class="textalign-c margin-20">
					<div class="counter-rambler">
						<div class="counter-rambler_i" id="counter-rambler"><a target="_blank" href="http://top100.rambler.ru/home?id=2900190"><img border="0" alt="Rambler's Top100" title="Rambler's Top100" src="http://counter.rambler.ru/top100.scn?2900190&amp;rn=1694076050&amp;v=0.3&amp;bs=1680x678&amp;ce=1&amp;rf=http%3A%2F%2F109.87.248.203%2Fhtml%2Fsocial%2F&amp;en=UTF-8&amp;pt=Happy%20Giraffe&amp;cd=24-bit&amp;sr=1680x1050&amp;la=ru-RU&amp;ja=1&amp;acn=Mozilla&amp;an=Netscape&amp;pl=Win32&amp;tz=-180&amp;fv=11.6%20r602&amp;sv&amp;le=0"></a></div>
						<a class="counter-rambler_a" href="http://www.rambler.ru/">Партнер «Рамблера»</a>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
  <!--<a id="btn-seo" href="#seo_tags" class="fancy" data-theme='white-square'></a>-->
  
</body>
</html>
