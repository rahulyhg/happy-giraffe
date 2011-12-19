<?php

class m111219_111146_edpd_tarifzone_data extends CDbMigration
{
	private $_table = 'shop_delivery_edpd_tarifzone';
	
	public function up()
	{
		$sql = "
			INSERT INTO `shop_delivery_edpd_tarifzone` (`id`, `zone`, `city`) VALUES 
			  (1, 0, 'Москва'),
			  (2, 1, 'Казань'),
			  (3, 0, 'Санкт-Петербург'),
			  (4, 2, 'Калининград'),
			  (5, 4, 'Абакан'),
			  (6, 1, 'Калуга'),
			  (7, 2, 'Анапа'),
			  (8, 3, 'Кемерово'),
			  (9, 4, 'Ангарск'),
			  (11, 1, 'Киров'),
			  (12, 5, 'Артем'),
			  (13, 4, 'Когалым'),
			  (14, 1, 'Архангельск'),
			  (15, 4, 'Комсомольск-на-Амуре'),
			  (16, 2, 'Астрахань'),
			  (17, 1, 'Кострома'),
			  (18, 1, 'Балаково'),
			  (19, 1, 'Краснодар'),
			  (20, 3, 'Барнаул'),
			  (21, 4, 'Красноярск'),
			  (22, 1, 'Белгород'),
			  (23, 2, 'Курган'),
			  (24, 3, 'Бийск'),
			  (25, 1, 'Курск'),
			  (26, 5, 'Биробиджан'),
			  (27, 4, 'Кызыл'),
			  (28, 4, 'Благовещенск'),
			  (29, 1, 'Липецк'),
			  (30, 5, 'Братск'),
			  (31, 5, 'Магадан'),
			  (32, 1, 'Брянск'),
			  (33, 3, 'Магнитогорск'),
			  (34, 1, 'Великий Новгород'),
			  (35, 2, 'Майкоп'),
			  (36, 4, 'Владивосток'),
			  (37, 3, 'Махачкала'),
			  (38, 5, 'Владикавказ'),
			  (39, 3, 'Минеральные Воды'),
			  (40, 1, 'Владимир'),
			  (41, 5, 'Мирный'),
			  (42, 1, 'Волгоград'),
			  (43, 3, 'Мурманск'),
			  (44, 1, 'Вологда'),
			  (45, 1, 'Набережные Челны'),
			  (46, 1, 'Воронеж'),
			  (47, 5, 'Назрань'),
			  (48, 4, 'Горно-Алтайск'),
			  (49, 5, 'Нальчик'),
			  (50, 1, 'Дзержинск'),
			  (51, 5, 'Находка'),
			  (52, 2, 'Екатеринбург'),
			  (53, 5, 'Нерюнгри'),
			  (54, 1, 'Иваново'),
			  (55, 4, 'Нижневартовск'),
			  (56, 1, 'Ижевск'),
			  (57, 1, 'Нижнекамск'),
			  (58, 4, 'Иркутск'),
			  (59, 1, 'Нижний Новгород'),
			  (60, 1, 'Йошкар-Ола'),
			  (61, 3, 'Нижний Тагил'),
			  (62, 3, 'Новокузнецк'),
			  (63, 1, 'Стерлитамак'),
			  (64, 1, 'Новороссийск'),
			  (65, 4, 'Сургут'),
			  (66, 3, 'Новосибирск'),
			  (67, 5, 'Сыктывкар'),
			  (68, 5, 'Новый Уренгой'),
			  (69, 1, 'Таганрог'),
			  (70, 5, 'Норильск'),
			  (71, 1, 'Тамбов'),
			  (72, 5, 'Ноябрьск'),
			  (73, 1, 'Тверь'),
			  (74, 5, 'Нягань'),
			  (75, 1, 'Тольятти'),
			  (76, 3, 'Омск'),
			  (77, 3, 'Томск'),
			  (78, 1, 'Орел'),
			  (79, 1, 'Тула'),
			  (80, 2, 'Оренбург'),
			  (81, 2, 'Тюмень'),
			  (82, 4, 'Орск'),
			  (83, 4, 'Улан-Удэ'),
			  (84, 1, 'Пенза'),
			  (85, 1, 'Ульяновск'),
			  (86, 3, 'Пермь'),
			  (87, 5, 'Усинск'),
			  (88, 1, 'Петрозаводск'),
			  (89, 1, 'Уфа'),
			  (90, 5, 'Петропавловск-Камчатский'),
			  (91, 5, 'Ухта'),
			  (92, 1, 'Псков'),
			  (93, 4, 'Хабаровск'),
			  (94, 2, 'Пятигорск'),
			  (95, 4, 'Ханты-Мансийск'),
			  (96, 1, 'Ростов-на-Дону'),
			  (97, 1, 'Чебоксары'),
			  (98, 1, 'Рыбинск'),
			  (99, 2, 'Челябинск'),
			  (100, 1, 'Рязань'),
			  (101, 1, 'Череповец'),
			  (102, 5, 'Салехард'),
			  (103, 2, 'Черкесск'),
			  (104, 1, 'Самара'),
			  (105, 4, 'Чита'),
			  (106, 1, 'Саранск'),
			  (107, 2, 'Элиста'),
			  (108, 1, 'Саратов'),
			  (109, 1, 'Энгельс'),
			  (110, 1, 'Смоленск'),
			  (111, 5, 'Южно-Сахалинск'),
			  (112, 2, 'Сочи'),
			  (113, 5, 'Якутск'),
			  (114, 1, 'Ставрополь'),
			  (115, 1, 'Ярославль'),
			  (116, 1, 'Старый Оскол');

		";
	}

	public function down()
	{
		$this->truncateTable($this->_table);
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