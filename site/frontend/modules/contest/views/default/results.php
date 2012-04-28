<div class="content-title">Победители конкурса</div>

<div class="wysiwyg-content">
	<p>Уважаемые пользователи, рады сообщить вам итоги конкурса «Веселая семейка»<br/>
        Благодарим всех пользователей, принявших участие и поделившихся замечательными интересными и яркими моментами вашей семейной жизни!
	</p>

	<p>Внимание!<br/>
        Так как в ходе проверки голосования были выявлены случаи искусственной накрутки голосов, было принято решение о создании экспертной комиссии для независимой оценки фотографий и определения победителей. <br/>
        Поздравляем победителей!
	</p>
</div>

<br>
<br>

<div class="contest-prizes-list clearfix">
	<ul>
		<li class="place-1">
			<div class="clearfix">
                <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array('user' => ContestWork::model()->findByPk($winners[0])->author)); ?>
			</div>
			<div class="place place-1"></div>
			<div class="title">
				<a href="">Мультиварка<br><b>Land Life YBW60-100A1 </b></a>
			</div>
		</li>
		<li class="place-2">
			<div class="clearfix">
                <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array('user' => ContestWork::model()->findByPk($winners[1])->author)); ?>
			</div>
			<div class="place place-2"></div>
			<div class="title">
				<a href="">Мультиварка<br><b>BRAND 37501</b></a>
			</div>
		</li>
		<li class="place-3">
			<div class="clearfix">
                <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array('user' => ContestWork::model()->findByPk($winners[2])->author)); ?>
			</div>
			<div class="place place-3"></div>
			<div class="title">
				<a href="">Мультиварка<br><b>Land Life YBD60-100A </b></a>
			</div>
		</li>
		<li class="place-4">
			<div class="clearfix">
                <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array('user' => ContestWork::model()->findByPk($winners[3])->author)); ?>
			</div>
			<div class="place place-4"></div>
			<div class="title">
				<a href="">Мультиварка<br><b>Polaris PMC 0506AD</b></a>
			</div>
		</li>
		<li class="place-5">
			<div class="clearfix">
                <?php $this->widget('application.widgets.avatarWidget.AvatarWidget', array('user' => ContestWork::model()->findByPk($winners[4])->author)); ?>
			</div>
			<div class="place place-5"></div>
			<div class="title">
				<a href="">Мультиварка<br><b>SUPRA MCS-4501</b></a>
			</div>
		</li>

	</ul>

</div>

<div id="gallery">
	<div id="photo">

        <?php if($work->title != ''): ?>
            <div class="title"><?php echo $work->title; ?></div>
        <?php endif; ?>

		<div class="big-photo">
			<div class="in">
                <?php
                $prev = $index == 0 ? $winners[4] : $winners[$index - 1];
                $next = $index == 4 ? $winners[0] : $winners[$index + 1];
                ?>
				<div class="img"><?php echo CHtml::image($work->photo->photo->getPreviewUrl(800, 400, Image::WIDTH)) ?></div>
				<a href="<?php echo $this->createUrl('/contest/results', array('id' => 1, 'work' => $prev)); ?>" class="prev"><i class="icon"></i></a>
				<a href="<?php echo $this->createUrl('/contest/results', array('id' => 1, 'work' => $next)); ?>" class="next"><i class="icon"></i></a>
			</div>
		</div>

	</div>
</div>


<?php $this->widget('site.frontend.widgets.commentWidget.CommentWidget', array(
    'model' => $work,
    'actions' => false,
    'readOnly' => true,
)); ?>

<?php
$remove_tmpl = $this->beginWidget('site.frontend.widgets.removeWidget.RemoveWidget');
$remove_tmpl->registerTemplates();
$this->endWidget();
?>


