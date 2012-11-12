<?php

class m121107_093012_contest_text extends CDbMigration
{
	public function up()
	{
        $this->execute("UPDATE `happy_giraffe`.`contest__contests` SET `text` = '<p>Говорят, что самая прекрасная из женщин – это женщина с ребенком на руках. Общаясь на «Веселом Жирафе», мы поняли, что у нас самые прекрасные мамы, которые держат на руках самых красивых малышей. Теперь мы хотим показать их всем!</p>
    <p>Примите участие в конкурсе «Мама и я» – покажитесь всему миру! Посмотрите на другие счастливые лица малышей и их мам из разных городов. А кроме приятного общения, которое гарантировано для всех участников конкурса, авторы самых интересных по мнению пользователей фотографий получат отличные призы.</p>' WHERE `contest__contests`.`id` = 2;");
        $this->execute("UPDATE `happy_giraffe`.`contest__contests` SET `title` = 'Веселая семейка', `text` = '<p><b>Весёлый жираф предлагает познакомиться!</b></p>
    <p>Ваша семья самая весёлая, самая интересная  – в общем, самая-самая? Тогда приглашаем вас принять участие в конкурсе семейной фотографии. Присылайте свое фото и фото своих близких, сделанные на катке , море или даже рыбалке. Не важно, где сделан снимок, главное, чтобы он вызывал улыбку!</p>
    <p><b>Обратите внимание:</b> к участию допускается только одно фото от одного пользователя! Победителей выберут пользователи путём голосования – поэтому смело приглашайте голосовать своих друзей и знакомых. Удачи!</p>' WHERE `contest__contests`.`id` = 1;");
	}

	public function down()
	{
		echo "m121107_093012_contest_text does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}