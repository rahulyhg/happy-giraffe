<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=""> <!--<![endif]-->
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/head.php'; ?>
</head>
<body class="body-club">

	<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/top-line-menu.php'; ?>
	
<div class="layout-container">
	<div class="layout-wrapper">
		<!-- Вставка секции в шапке страницы -->
		<?php $headerSection = '
		<a class="layout-header-section_a" href="">
			<img alt="" src="/images/section/cook/banner-header-section.jpg" class="layout-header-section_img">
			<span class="layout-header-section_text">Кулинария</span>
		</a>
		'?>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/block/global/layout-header.php'; ?>
		
		<div id="content" class="clearfix">
			
			<div id="crumbs"><a href="">Главная</a> > <a href="">Сервисы</a> > <span>Кулинарные рецепты  </span></div>
			
			<div id="cook-recipe">

				<div class="clearfix">
					
					<div class="main">
						
						<div class="main-in">
							
							<div class="entry recipe-article clearfix">
								
								<h1 class="fn">
									Курица в пиве с рисом 
									<a href="" class="icon-edit"></a>
									<a href="" class="icon-remove"></a>
								</h1>
								
								<div class="entry-header clearfix">
								
									<div class="user-info user-info-small clearfix">
										<div class="ava female small"></div>
										<div class="details">
											<a href="" class="username">Дарья</a>
											<div class="date">Сегодня, 13:25</div>
										</div>
									</div>
									
									<div class="meta meta-small">
										<div class="views"><span href="#" class="icon"></span> <span>265</span></div>
										<div class="comments">
											<a href="#" class="icon"></a>
											<a href="">15233</a>
										</div>
									</div>
									
								</div>
								
								<div class="entry-content">
								
									<div class="recipe-right">
										<div class="cook-book-info">
											<a href="" >
												<span>Рецепт в моей <br />кулинарной книге</span>
												<i class="icon-exist"></i>
											</a>
											<!-- display-b для отображения на стр примера -->
											<div class="favorites-add-popup display-b">
												<div class="favorites-add-popup_t">Добавить запись в избранное</div>
												<div class="favorites-add-popup_i clearfix">
													<img class="favorites-add-popup_i-img" alt="" src="/images/example/w60-h40.jpg">
													<div class="favorites-add-popup_i-hold">Неравный брак. Смертельно опасен или жизненно необходим?</div>
												</div>
												<div class="favorites-add-popup_row">
													<label class="favorites-add-popup_label" for="">Теги:</label>
													<span class="favorites-add-popup_tag">
														<a class="favorites-add-popup_tag-a" href="">отношения</a>
														<a class="ico-close" href=""></a>
													</span>
													<span class="favorites-add-popup_tag">
														<a class="favorites-add-popup_tag-a" href="">любовь</a>
														<a class="ico-close" href=""></a>
													</span>
												</div>
												<div class="favorites-add-popup_row margin-b10">
													<a href="" class="textdec-none">
														<span class="ico-plus2 margin-r5"></span>
														<span class="a-pseudo-gray color-gray">Добавить тег</span>
													</a>
												</div>
												<div class="favorites-add-popup_row">
													<label class="favorites-add-popup_label" for="">Комментарий</label>
													<div class="float-r color-gray">0/150</div>
												</div>
												<div class="favorites-add-popup_row">
													<textarea placeholder="Введите комментарий" class="favorites-add-popup_textarea" rows="2" cols="25" id="" name=""></textarea>
												</div>
												<div class="favorites-add-popup_row textalign-c margin-t10">
													<a class="btn-gray-light" href="">Отменить</a>
													<a class="btn-green" href="">Добавить</a>
												</div>
											</div>
										</div>
										<div class="cook-book-info">
											<a href="" >
												<span>Добавить в мою <br />кулинарную книгу</span>
												<i class="icon-add"></i>
											</a>
										</div>
										<div class="recipe-user-adds">
											<p>Этот рецепт также добавили:</p>
											<ul class="clearfix">
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/52756/small/10eb85806fb3ae57ab97b9d15fa3f21f.JPG"></a>
												</li>
												<li>
													<a href="" class="ava small female"><img alt="" src="http://img.happy-giraffe.ru/avatars/20976/small/d1d850f5318107ff8b3c0272b13b53bc.JPG"></a>
												</li>
												<li>
													<span class="text">и еще 148</span>
												</li>
											</ul>
										</div>
										
									</div>
									
									<div class="recipe-photo">
										
										<a href="" class="add-photo">
											<i class="icon"></i>
											<span>Вы уже готовили это блюдо?<br/>Добавьте фото!</span>
										</a>
										
										<div class="big">
											<img class="result-photo" src="/images/cook_recipe_img_01.jpg" width="460" />
										</div>
										
										<div class="thumbs clearfix">
											
											<ul class="clearfix">
												<li>
													<a href=""><img src="/images/cook_recipe_img_02.jpg" width="82" height="60"/></a>
												</li>
												<li><a href=""><img src="/images/cook_recipe_img_03.jpg" width="82"  height="60" class="photo" /></a></li>
												<li>
													<a href=""><img src="/images/cook_recipe_img_02.jpg" width="82" height="60" class="photo" /></a>
												</li>
												<li><a href=""><img src="/images/cook_recipe_img_03.jpg" width="82"  height="60" class="photo" /></a></li>
												<li>
												<a href="" class="add">
													<span>Уже готовили</span>
													<i class="icon"></i>
													<span class="blue" >Поделитесь <br /> фото!</span>
												</a>
												</li>
											</ul>
											<a href="">Смотреть еще 25 фото</a>
										</div>
										
									</div>
									
									<div style="clear:left;"></div>
									
									<div class="recipe-description clearfix">
										<div class="recipe-description-holder">
											<span class="country">
												<span class="flag-big flag-big-ua"></span>
												Украинская кухня
											</span>
											<div class="recipe-description-item">
												<div class="icon-time-1 tooltip" title="Время подготовки"></div>
												02 : 00
											</div>
											<div class="recipe-description-item">
												<div class="icon-time-2 tooltip" title="Время приготовления"></div>
												02 : 00
											</div>
											<div class="recipe-description-item">
												<div class="icon-yield tooltip" title="Количество порций"></div>
												на <span class="yeild">6 персон</span>
											</div>
										</div>
									</div>
									
									<div class="clearfix">
										<div class="recipe-right">
											
											<div class="nutrition">
												
												<div class="block-title">Калорийность блюда</div>
												
												<div class="portion">
													<a href="" class="active">На 100 г.</a>
													|
													<a href="" class="disabled">На порцию</a>
													
												</div>
											
												<ul>
													<li class="n-calories">
														<div class="icon">
															<i>К</i>
															Калории
														</div>
														<div class="nutrition-tx">
															<span class="calories">11589,2</span>
															<span class="gray">ккал.</span>
														</div>
													</li>
													<li class="n-protein">
														<div class="icon">
															<i>Б</i>
															Белки
														</div>
														<div class="nutrition-tx">
															<span class="protein">18</span>
															<span class="gray">г.</span>
														</div>
													</li>
													<li class="n-fat">
														<div class="icon">
															<i>Ж</i>
															Жиры
														</div>
														<div class="nutrition-tx">
															<span class="fat">10</span>
															<span class="gray">г.</span>
														</div>
													</li>
													<li class="n-carbohydrates">
														<div class="icon">
															<i>У</i>
															Углеводы
														</div>
														<div class="nutrition-tx">
															<span class="carbohydrates">70</span>
															<span class="gray">г.</span>
														</div>
													</li>
													
												</ul>
												
											</div>
										</div>
										<h2>Ингредиенты</h2>
										
										<ul class="ingredients">
											<li class="ingredient">
												<span class="name">курица</span>
												- <span class="amount">1300 г.</span>
											</li>
											<li class="ingredient">
												<span class="name">пива</span>
												- <span class="amount">0,5 л</span>			
											</li>
											<li class="ingredient">
												<span class="name">соль</span>
												- <span class="amount">2 ч. л.</span>
											</li>
											<li class="ingredient">
												<span class="name">перец</span>
												- <span class="amount">1 ч. л.</span>
											</li>
											<li class="ingredient">
												<span class="name">специи по вкусу</span>
											</li>
										</ul>
									</div>
									
									<h2>Приготовление</h2>
									
									<div class="cook-instructions wysiwyg-content">
									
										<p><em>Мои родители и я пошел в поход на Верхний полуостров штата Мичиган летом после моего старшего года средней школы. Это один из тех поездок, которые всегда будут оставаться со мной. Я был одним из тех больших основные переходные периоды в жизни (хотя, как всегда, я не узнал его в то время) и поездка с родителями в красивой части страны было только, что мне нужно, чтобы чувствовать себя в безопасности , безопасный и готовы отправиться в следующую главу моей жизни.</em></p>
										<div class="instructions">
										<ol class="instructions-list">
											<li class="clearfix">Курицу нарезать на кусочки, выложить в форму для запекания,
												посолить, поперчить, добавить специи по вкусу.</li>
											<li class="clearfix">Курицу залить пивом, поставить в духовку.</li>
											<li class="clearfix">Мои родители и я пошел в поход на Верхний полуостров штата Мичиган летом после моего старшего года средней школы. Это один из тех поездок, которые всегда будут оставаться со мной. Я был одним из тех больших основные переходные периоды в жизни (хотя, как всегда, я не узнал его в то время) и поездка с родителями в красивой части страны было только, что мне нужно, чтобы чувствовать себя в безопасности , безопасный и готовы отправиться в следующую главу моей жизни.</li>
											<li class="clearfix">Жарить при температуре 180 градусов в течение 40-45 минут.</li>
										</ol>
										</div>
										<div class="clearfix">
											<div class="cook-diabets">
												<!-- 
												Диаграмма для диабетиков имеет 4 состояния на сколько не подходит 
												val0 (по умолчанию даже без класса) 
												val33
												val66
												val100
												-->
												<div class="cook-diabets-chart val33">
													<span class="text">20.5</span>
												</div>
												<div class="cook-diabets-desc">Подходит для диабетиков</div>
											</div>
											
											<div class="cook-article-tags">
												<div class="cook-article-tags-title">Теги</div>
												<ul class="cook-article-tags-list">
													<li><a href="">Рыбные блюда</a></li>
													<li><a href="">Рыбные блюда</a></li>
													<li><a href="">Рыбные </a></li>
													<li><a href="">Рыбные 234234 блюда</a></li>
													<li><a href="">Рыбные блюда</a></li>
													<li><a href="">Рыбные блюда</a></li>
													<li><a href="">Рыбные блюда</a></li>
												</ul>
											</div>
										</div>
									</div>
								
								</div>
								
							</div>
							
							<div class="cook-more clearfix">
								<div class="block-title">
									Еще вкусненькое
								</div>
								<ul class="clearfix">
									<li>
										<div class="content">
											<a href=""><img src="/images/cook_more_img_01.jpg" height="105" width="120"></a>
										</div>
										<div class="item-title"><a href="">Ригатони макароны с соусом из помидор говядины</a></div>
										<div class="user clearfix">
											<div class="user-info clearfix">
												<a class="ava female small"></a>
												<div class="details">
													<a href="" class="username">Дарья</a>
												</div>
											</div>
										</div>
									</li>
									<li>
										<div class="content">
											<a href=""><img src="/images/cook_recipe_img_01.jpg" height="105" width="120"></a>
										</div>
										<div class="item-title"><a href="">Торт песочный с орехами,черникой и клубникой</a></div>
										<div class="user clearfix">
											<div class="user-info clearfix">
												<a class="ava female small"></a>
												<div class="details">
													<a href="" class="username">Дарья</a>
												</div>
											</div>
										</div>
									</li>
									
									<li>
										<div class="content">
											<a href=""><img src="/images/cook_more_img_01.jpg" height="105" width="120"></a>
										</div>
										<div class="item-title"><a href="">Ригатони макароны с соусом из помидор говядины</a></div>
										<div class="user clearfix">
											<div class="user-info clearfix">
												<a class="ava female small"></a>
												<div class="details">
													<a href="" class="username">Дарья</a>
												</div>
											</div>
										</div>
									</li>
									<li>
										<div class="content">
											<a href=""><img src="/images/cook_recipe_img_01.jpg" height="105" width="120"></a>
										</div>
										<div class="item-title"><a href="">Умный рулет</a></div>
										<div class="user clearfix">
											<div class="user-info clearfix">
												<a class="ava female small"></a>
												<div class="details">
													<a href="" class="username">Дарья</a>
												</div>
											</div>
										</div>
									</li>
									
									
								</ul>
							</div>
							
							<div class="default-comments">
							
								<div class="comments-meta clearfix">
									<div class="title">Комментарии</div>
									<div class="count">(55)</div>
								</div>
								
								<div class="comment-add clearfix">
									<div class="comment-add_user">
										<a href="">Авторизируйтесь</a>
										<div class="social-small-row clearfix">
											<em>или войти с помощью</em> <br />
											<ul class="social-list-small">
												<li class="odnoklasniki"><a href="#"></a></li>
												<li class="mailru"><a href="#"></a></li>
												<li class="vkontakte"><a href="#"></a></li>
												<li class="facebook"><a href="#"></a></li>
											</ul>
										</div>
									</div>
									<div class="comment-add_form-holder">
										<input type="text" name="" class="input-text" placeholder="Введите ваш комментарий"/>
									</div>
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
														
														<p><img src="/images/example/12.jpg" width="300" class="content-img" /><i>Атопический дерматит у детей до года локализуется в основном на щечках и ягодицах, реже на теле и конечностях, на коже головы возможно появление корочек. Когда малышу исполнится год, то места высыпаний меняются – теперь поражаются локтевые сгибы (внутри и снаружи), подколенные впадины, шея. После трех лет высыпания начинают поражать также и кисти рук.</i></p>
														
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
									
								</ul>
								
							</div>
							
	<script type="text/javascript">
	//<![CDATA[

		$(function(){

			/* skin hgru-comment */
			CKEDITOR.replace( 'editor',
				{
					skin : 'hgrucomment',
					toolbar : [	
						['Bold','Italic','Underline','-','Image', 'Smiles']
					],
					toolbarCanCollapse: false,
					disableObjectResizing: false,
					height: 80
				});

			/* js дважды для двух редакторов на стр. */
			/* skin hgru-comment */
			CKEDITOR.replace( 'editor2',
				{
					skin : 'hgrucomment',
					toolbar : [	
						['Bold','Italic','Underline','-','Image', 'Smiles']
					],
					toolbarCanCollapse: false,
					disableObjectResizing: false,
					height: 80
				});
			});

	//]]>
	</script>
						
								
					<div class="comment-add clearfix">
						<div class="comment-add_user">
							<a href="">Авторизируйтесь</a>
							<div class="social-small-row clearfix">
								<em>или войти с помощью</em> <br />
								<ul class="social-list-small">
									<li class="odnoklasniki"><a href="#"></a></li>
									<li class="mailru"><a href="#"></a></li>
									<li class="vkontakte"><a href="#"></a></li>
									<li class="facebook"><a href="#"></a></li>
								</ul>
							</div>
						</div>
						<div class="comment-add_form-holder">
							<input type="text" name="" class="input-text" placeholder="Введите ваш комментарий"/>
						</div>
					</div>
					
					<div class="comment-add active clearfix">
						<div class="comment-add_user">
							<a href="">Авторизируйтесь</a>
							<div class="social-small-row clearfix">
								<em>или войти с помощью</em> <br />
								<ul class="social-list-small">
									<li class="odnoklasniki"><a href="#"></a></li>
									<li class="mailru"><a href="#"></a></li>
									<li class="vkontakte"><a href="#"></a></li>
									<li class="facebook"><a href="#"></a></li>
								</ul>
							</div>
						</div>
						<div class="comment-add_form-holder">
							<textarea cols="80" id="editor" name="editor" rows="10"></textarea>
							<div class="a-right">
						        <button class="btn-gray medium cancel">Отмена</button>
						        <button class="btn-green medium">Добавить</button>
						    </div>
						</div>
					</div>
					
					<div class="comment-add active clearfix">
						<div class="comment-add_user">
							<div class="comment-add_user-ava">
   								 <a href="" class="ava female"><img alt="" src="http://img.happy-giraffe.ru/avatars/13623/ava/7acd577045e2014b4d26ecd33f6ce6d2.jpeg"></a>
					              <span class="comment-add_username">Татьяна Пахоменко </span>
                   			</div>
						</div>
						<div class="comment-add_form-holder">
							<textarea cols="40" id="editor2" name="editor2" rows="5"></textarea>
							<div class="a-right">
						        <button class="btn-gray medium cancel">Отмена</button>
						        <button class="btn-green medium">Добавить</button>
						    </div>
						</div>
					</div>
							
						</div>
						
					</div>
					
					<div class="side-left">
					
						<div class="recipe-search clearfix">
							<form>
								<input type="text" class="text" placeholder="Поиск из 12 587 рецептов" />
								<input type="submit" value="" class="submit"/>
							</form>
						</div>
						
						<div class="recipe-menu">
							<ul>
								<li>
									<a href="">
										<span class="icon-holder">
											<i class="icon-cook-add"></i>
										</span><span class="link-holder">
											<span class="link">Добавить рецепт</span>
										</span>
									</a>
								</li>
								<li>
									<a href="">
										<span class="icon-holder">
											<i class="icon-cook-book"></i>
										</span><span class="link-holder">
											<span class="link">Моя кулинарная книга</span>
											<span class="pink">25  рецептов</span>
										</span>
									</a>
								</li>
							</ul>
						</div>
						
						<div class="recipe-categories">
							
							<ul>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-0"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Все рецепты</span>
											<span class="count">12 582</span>
										</span>
									</a>
								</li>
								<li class="active">
									<a href="" class="cook-cat active">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-1"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Первые блюда</span>
											<span class="count">582</span>
										</span>
									</a>
									<img src="/images/recipe-categories-arrow.png" alt="" class="tale" />
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-2"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Вторые блюда</span>
											<span class="count">582</span>
										</span>
									</a>
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-3"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Салаты</span>
											<span class="count">12 555 582</span>
										</span>
									</a>
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-4"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Закуски и&nbsp;бутерброды</span>
											<span class="count">12 582</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-5"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Сладкая выпечка</span>
											<span class="count">12 582</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-6"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Несладкая выпечка</span>
											<span class="count">12 582</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-7"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Торты и&nbsp;пирожные</span>
											<span class="count">12 582</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-8"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Десерты</span>
											<span class="count">122</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-9"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Напитки</span>
											<span class="count">2</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-10"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Соусы и&nbsp;кремы</span>
											<span class="count">2</span>
										</span>
									</a>									
								</li>
								<li>
									<a href="" class="cook-cat">
										<span class="cook-cat-holder">
											<i class="icon-cook-cat icon-recipe-11"></i>
										</span>
										<span class="cook-cat-frame">
											<span>Консервация</span>
											<span class="count">6 662</span>
										</span>
									</a>									
								</li>
							</ul>
							
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