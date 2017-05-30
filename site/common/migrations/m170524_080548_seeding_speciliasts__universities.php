<?php

class m170524_080548_seeding_speciliasts__universities extends CDbMigration
{
	public function up()
	{
	    $this->execute(
        'INSERT INTO specialists__universities (`group_id`, `country_id`, `city_id`, `name`, `site`, `address`) VALUES
                (1, 1, 7125, "Северный государственный медицинский университет", "www.nsmu.ru", "просп. Троицкий, 51, Архангельск, Архангельская обл., 163000"),
                (1, 1, 143007, "Астраханский государственный медицинский университет", "astgmu.ru", "ул. Бакинская, 121, Астрахань, Астраханская обл., 414024"),
                (1, 1, 169125, "Алтайский государственный медицинский университет", "www.agmu.ru", "пр. Ленина, 40, Барнаул, Алтайский край, 656038"),
                (1, 1, 97694, "Амурская государственная медицинская академия", "www.amursma.ru", "ул. Горького, 95, Благовещенск, Амурская обл., 675000"),
                (1, 1, 77520, "Тихоокеанский государственный медицинский университет", "www.tgmu.ru", "пр-т Острякова, 2, Владивосток, Приморский край, 690002"),
                (1, 1, 77520, "Владивостокский государственный медицинский университет", "", "сейчас ТГМУ (тихоокеанский)"),
                (1, 1, 118328, "Северо-Осетинская государственная медицинская академия", "sogma.ru", "Пушкинская ул., 40, Владикавказ, Респ. Северная Осетия-Алания, 362007"),
                (1, 1, 20021, "Волгоградский государственный медицинский университет(ВолгГМУ)", "www.volgmed.ru/ru/", "400131, г. Волгоград, площадь Павших Борцов, 1, каб. 3-34"),
                (1, 1, 170510, "Воронежский государственный медицинский университет имени Н. Н. Бурденко (ВГМУ)", "www.vsmaburdenko.ru", "Студенческая ул., 10, Воронеж, Воронежская обл., 394036"),
                (1, 1, 136478, "Уральский государственный медицинский университет (УГМУ)", "www.usma.ru", "ул. Репина, 3, Екатеринбург, Свердловская обл., 620014"),
                (1, 1, 34356, "Ивановская государственная медицинская академия (ИвГМА)", "www.isma.ivanovo.ru", "Шереметевский просп., 8, Иваново, Ивановская обл., 153012"),
                (1, 1, 94891, "Ижевская государственная медицинская академия (ИГМА)", "www.igma.ru", "ул. Коммунаров, 281, Ижевск, республика Удмуртия, 426034"),
                (1, 1, 166711, "Иркутский государственный медицинский университет (ИГМУ)", "www.ismu.baikal.ru/ismu/news.php", "ул. Красного Восстания, 1, Иркутск, Иркутская обл., 664003"),
                (1, 1, 166711, "Иркутская государственная медицинская академия последипломного образования (ИГМАПО)", "igmaporj.bget.ru", ""),
                (1, 1, 25280, "Казанский государственный медицинский университет (КГМУ)", "kazangmu.ru", "ул. Бутлерова, 49, Казань, Респ. Татарстан, 420012"),
                (1, 1, 25280, "Казанская государственная медицинская академия", "kgma.info", "ул. Муштари, 11, Казань, Респ. Татарстан, 420012"),
                (1, 1, 14909, "Кемеровский государственный медицинский университет" , "www.kemsma.ru/mediawiki/index.php/%D0%97%D0%B0%D0%B3%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F_%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0" ,"ул. Ворошилова, 22А, Кемерово, Кемеровская обл., 650056"),
                (1, 1, 6322, "Кировский государственный медицинский университет", "www.kirovgma.ru", "ул. Карла Маркса, 112, Киров, Кировская обл., 610027"),
                (1, 1, 15004, "Кубанский государственный медицинский университет (КубГМУ)", "www.ksma.ru", "ул. Седина, 4, Краснодар"),
                (1, 1, 117986, "Красноярский государственный медицинский университет (КрасГМУ имени профессора В. Ф. Войно-Ясенецкого)", "krasgmu.ru", "ул. Партизана Железняка, 1, Красноярск, Красноярский край, 660022"),
                (1, 1, 175926, "Курский государственный медицинский университет (КГМУ)", "www.kurskmed.com", "305041, ул. Карла Маркса, 3, Курск, Курская обл., 305004"),
                (1, 1, 46141, "Дагестанский государственный медицинский университет", "dgma.ru", "367015, пр Ленина, 1, Махачкала, Респ. Дагестан, 367016"),
                (1, 1, 180121, "Первый Московский государственный медицинский университет имени И. М. Сеченова", "sechenov.ru", "Трубецкая улица, 8, Москва, 119048"),
                (1, 1, 180121, "Российский национальный исследовательский медицинский университет имени Н.И. Пирогова", "www.rsmu.ru", "ул. Островитянова, 1, Москва, 117997"),
                (1, 1, 180121, "Московский государственный медико-стоматологический университет,Россия", "www.msmsu.ru", "Делегатская ул., 20/1, Москва, 127473"),
                (1, 1, 180121, "Московский областной научно-исследовательский клинический институт (МОНИКИ)", "www.monikiweb.ru", "ул. Щепкина, 61/2, к.1, Москва, 129272"),
                (1, 1, 180121, "Российская медицинская академия последипломного образования (РМАПО)", "rmapo.ru", "Баррикадная ул., 2/1, стр 1, Москва, 123242"),
                (1, 1, 180121, "Институт повышения квалификации ФМБА России", "medprofedu.ru", "Волоколамское ш., 91, Москва, 125310"),
                (1, 1, 180121, "Институт усовершенствования врачей МУНКЦ им. П.В. Мандрыка МО РФ,Россия", "", "г. Москва, ул. Малая Черкизовская, дом 7"),
                (1, 1, 180121, "Институт усовершенствования врачей ФГУ «Национальный медико-хирургический Центр им. Н.И. Пирогова Росздрава»", "www.pirogov-center.ru", "105203 г. Москва, ул. Нижняя Первомайская, д. 70"),
                (1, 1, 180121, "Учебно-научный медицинский центр по непрерывному медицинскому и фармацевтическому образованию", "fgou-vunmc.ru/about/", "107564, г. Москва, ул. Лосиноостровская, д. 2"),
                (1, 1, 180121, "Учебно-научный медицинский центр Управления делами Президента Российской Федерации", "cgma.su", "121359, Москва, улица Маршала Тимошенко, дом 19, стр. 1А"),
                (1, 1, 167470, "Нижегородская государственная медицинская академия (НижГМА)", "www.nizhgma.ru", "пл. Минина и Пожарского, 10/1, Нижний Новгород, Нижегородская обл., 603005"),
                (1, 1, 167470, "Военно-медицинский институт ФСБ России", "", "Нижегородская область, Нижний Новгород г., Нижневолжская набережная, 1/1"),
                (1, 1, 159774, "Новокузнецкий государственный институт усовершенствования врачей", "ngiuv.ru", "просп. Строителей, 5, Новокузнецк, Кемеровская обл., 654005"),
                (1, 1, 115287, "Новосибирский государственный медицинский университет", "www.ngmu.ru", "630091, г. Новосибирск, Красный проспект, 52"),
                (1, 1, 55370, "Омский государственный медицинский университет", "omsk-osma.ru", "ул. Ленина, 12, Омск, Омская обл., 644099"),
                (1, 1, 89525, "Оренбургский государственный медицинский университет(ОрГМУ)", "www.orgma.ru", "Советская ул., 6, Оренбург, Оренбургская обл., 460000"),
                (1, 1, 55386, "Пензенский институт усовершенствования врачей", "", ""),
                (1, 1, 65918, "Пермская государственная медицинская академия им. акад. Е.А. Вагнера", "", ""),
                (1, 1, 65918, "Пермская государственная фармацевтическая академия", "", ""),
                (1, 1, 65918, "Пермский краевой центр повышения квалификации работников здравоохранения", "", ""),
                (1, 1, 85650, "Пятигорский медико-фармацевтический институт - филиал ГБОУ ВПО \'ВолгГМУ\' МЗ РФ", "", ""),
                (1, 1, 120582, "Ростовский государственный медицинский университет", "", ""),
                (1, 1, 50437, "Рязанский государственный медицинский университет им. акад. И.П. Павлова", "", ""),
                (1, 1, 165230, "Самарский государственный медицинский университет", "", ""),
                (1, 1, 180123, "Санкт-Петербургский государственный педиатрический медицинский университет", "gpma.ru", ""),
                (1, 1, 180123, "Санкт-Петербургская государственная химико-фармацевтическая академия", "www.spcpa.ru", ""),
                (1, 1, 180123, "Первый Санкт-Петербургский государственный медицинский университет им. акад. И.П. Павлова", "www.1spbgmu.ru/ru/", ""),
                (1, 1, 180123, "Северо-Западный государственный медицинский университет им. И.И. Мечникова (сейчас включает в себя Санкт-Петербургская медицинская академия последипломного образования)", "www.szgmu.ru/", ""),
                (1, 1, 180123, "Санкт-Петербургская медицинская академия последипломного образования (входит в Северо-Западный государственный медицинский университет им. И.И. Мечникова после реорганизации вместе с Санкт-Петербургская государственная медицинская академия имени И. И. Мечникова)", "", ""),
                (1, 1, 180123, "Военно-медицинская академия имени С.М. Кирова", "www.vmeda.org", ""),
                (1, 1, 165230, "Самарский государственный медицинский университет", "", ""),
                (1, 1, 30611, "Медицинский институт Мордовского государственного университета им. Н.П. Огарёва", "", ""),
                (1, 1, 70513, "Саратовский государственный медицинский университет им. В.И. Разумовского", "", ""),
                (1, 1, 50603, "Крымский государственный медицинский университет им. С. И. Георгиевского (КГМУ)", "", ""),
                (1, 1, 176212, "Смоленская государственная медицинская академия", "", ""),
                (1, 1, 151702, "Ставропольская государственная медицинская академия", "", ""),
                (1, 1, 95389, "Тверская государственная медицинская академия", "", ""),
                (1, 1, 95811, "Сибирский государственный медицинский университет", "", ""),
                (1, 1, 64170, "Тюменская государственная медицинская академия", "", ""),
                (1, 1, 38631, "Институт медицины и экологии Ульяновского государственного университета", "", ""),
                (1, 1, 92160, "Башкирский государственный медицинский университет", "", ""),
                (1, 1, 55912, "Дальневосточный государственный медицинский университет", "", ""),
                (1, 1, 172417, "Ханты-Мансийский государственный медицинский институт", "", ""),
                (1, 1, 176196, "Институт усовершенствования врачей Министерства здравоохранения Чувашской Республики", "", ""),
                (1, 1, 147500, "Южно-уральский государственный медицинский университет", "www.chelsma.ru", ""),
                (1, 1, 147500, "Уральская государственная медицинская академия дополнительного образования", "", ""),
                (1, 1, 57115, "Читинская государственная медицинская академия", "", ""),
                (1, 1, 148740, "Медицинский институт Северо-Восточного федерального университета им. М.К. Аммосова", "", ""),
                (1, 1, 57455, "Ярославский государственный медицинский университет", "ysmu.ru/index.php/ru/", ""),
                (1, 4, 180132, "Казахстанский медицинский университет", "", ""),
                (1, 4, 180132, "Казахский национальный медицинский университет имени С. Д. Асфендиярова", "", ""),
                (1, 4, 180132, "Казахстанско-Российский Медицинский Университет", "", ""),
                (1, 4, 180132, "Казахстанский медицинский университет \'ВШОЗ\'", "", ""),
                (1, 4, 180170, "Государственный медицинский университет города Семей", "", ""),
                (1, 4, 198385, "Западно-Казахстанский государственный медицинский университет имени Марата Оспанова", "", ""),
                (1, 4, 180159, "Карагандинский государственный медицинский университет", "", ""),
                (1, 4, 180128, "Медицинский университет Астана", "", ""),
                (1, 3, 180158, "Белорусский государственный медицинский университет,Белоруссия", "", ""),
                (1, 3, 180148, "Витебский государственный медицинский университет,Белоруссия", "", ""),
                (1, 3, 180178, "Гомельский государственный медицинский университет,Белоруссия", "", ""),
                (1, 3, 180225, "Гродненский государственный медицинский университет,Белоруссия", "", ""),
                (1, 2, 180378, "Буковинский государственный медицинский университет,Украина", "", ""),
                (1, 2, 180245, "Винницкий Национальный Медицинский Университет им. Н.Пирогова", "", ""),
                (1, 2, 180226, "Днепропетровская Государственная Медицинская Академия", "", ""),
                (1, 2, 180226, "Днепропетровский национальный университет имени Олеся Гончара (ДНУ)", "", ""),
                (1, 2, 180145, "Донецкий Национальный медицинский университет им. М.Горького", "", ""),
                (1, 2, 180221, "Запорожский государственный медицинский университет", "", ""),
                (1, 2, 180209, "Луганский государственный медицинский университет", "", ""),
                (1, 2, 180289, "Львовский государственный медицинский университет им.Д.Галицкого", "", ""),
                (1, 2, 180289, "Львовский государственный университет имени Ивана Франка (ЛНУ)", "", ""),
                (1, 2, 180289, "Львовский медицинский институт (ЛМИ)", "", ""),
                (1, 2, 180165, "Киевский медицинский университет", "", ""),
                (1, 2, 180165, "Национальный медицинский университет им. О. О. Богомольца", "", ""),
                (1, 2, 180165, "Медицинский институт Украинской ассоциации народной медицины", "", ""),
                (1, 2, 180165, "Киевский международный университет (КиМУ)", "", ""),
                (1, 2, 180165, "Международная академия экологии и медицины (МАЭМ)", "", ""),
                (1, 2, 180165, "Украинская Военно-медицинская академия", "", ""),
                (1, 2, 180165, "Национальная медицинская академия последипломного образования имени П.Л. Шупика", "", ""),
                (1, 2, 180381, "Украинская медицинская стоматологическая академия", "", ""),
                (1, 2, 180156, "Харьковский национальний медицинский университет (ХНМУ)", "", ""),
                (1, 2, 180156, "Харьковский национальный университет имени В.Н. Каразина", "", ""),
                (1, 2, 180156, "Национальный фармацевтический университет (НФаУ)", "", ""),
                (1, 2, 180156, "Харьковская Медицинская Академия Последипломного Образования", "", ""),
                (1, 2, 180378, "Буковинский государственный медицинский университет (БГМУ)", "", ""),
                (1, 2, 180455, "Ивано-Франковский национальный медицинский университет (ІФГМУ)", "", ""),
                (1, 2, 180161, "Одесский национальный медицинский университет (ОГМУ)", "", ""),
                (1, 2, 180161, "Международный гуманитарный университет", "", ""),
                (1, 2, 180174, "Международный классический университет им. Филиппа Орлика", "", ""),
                (1, 2, 180374, "Тернопольский государственный медицинский университет им. И. Я. Горбачевского (ТГМУ)", "", ""),
                (1, 2, 180191, "Ужгородський национальний университет (УжНУ)", "", ""),
                (1, 2, 180174, "Черноморский государственный университет имени Петра Могилы", "", "");
            '
        );
	}

	public function down()
	{
	    $this->truncateTable('specialists__universities');
	}

}