<p>У вас есть дети или вы только собираетесь стать родителями?</p>

<p>Социальная сеть для всей семьи «Весёлый жираф» приветствует вас! Заходите, осматривайтесь: здесь собрано много интересной и полезной информации для каждого члена семьи.</p>
<ul style="list-style-type: disc; margin-left: 20px;">
	<li>Как подготовиться к беременности и как грамотно родить.</li>
	<li>Как вырастить ребёнка здоровым и что делать, если он заболел.</li>
	<li>Где водятся хорошие няни, и какой детский сад лучше.</li>
	<li>Какие знания даёт школа, а чему должны научить родители.</li>
	<li>Где находится лучшее место для отдыха.</li>
	<li>Как подобрать семейный автомобиль и купить самый модный наряд.</li>
	<li>Что приготовить на ужин.</li>
	<li>Всё, что нужно и чуть-чуть больше.</li>
</ul>
<p>Здесь можно пообщаться с другими родителями, получить консультацию специалиста, прочитать экспертные статьи, ответить на вопросы тестов. А ещё «Весёлый жираф» предлагает принять участие в интересных конкурсах и получить за них призы.</p>
<p>Социальная сеть для всей семьи «Весёлый жираф» – проводите время весело и с пользой!</p>

<?php $this->widget('application.widgets.user.location.LocaionWidget',array(
    'user'=>User::getUserById(Yii::app()->user->getId()))) ?><br><br>

<?php $this->widget('application.widgets.user.horoscope.HoroscopeWidget',array(
    'user'=>User::getUserById(Yii::app()->user->getId()))) ?><br><br>

<?php $this->widget('application.widgets.user.interests.InterestsWidget',array(
    'user'=>User::getUserById(Yii::app()->user->getId()))) ?><br><br>