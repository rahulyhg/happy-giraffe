<?php

class m130902_105518_fill_club_data extends CDbMigration
{
    private $_table = '';

    public function up()
    {
        $this->execute("INSERT INTO `community__sections` (`id`, `title`) VALUES
(1, 'Беременность и дети'),
(2, 'Наш дом'),
(3, 'Красота и здоровье'),
(4, 'Мужчина и женщина'),
(5, 'Интересы и увлечения'),
(6, 'Отдых');

INSERT INTO `community__clubs` (`id`, `title`, `description`, `section_id`) VALUES
(1, 'Планирование', 'Правильная подготовка к зачатию - залог успешной беременности. Место общения будущих родителей, которые знают, что беременность начинается с планирования.', 1),
(2, 'Беременность и роды', 'Счастливая беременность и легкие роды: делимся опытом, обсуждаем советы профессионалов, настраиваемся на позитив!', 1),
(3, 'Дети до года', 'Первый год жизни ребенка - начало родительского стажа. Все, что нужно знать молодым мамам и папам: советы и мнения профессионалов, истории из жизни и забавные факты о малышах.', 1),
(4, 'Дети старше года', 'Как воспитывать активных карапузов, на что обратить внимание при уходе за ними, советы по выбору досуга и все, о чем нужно знать родителям “годовасиков” и деток постарше.', 1),
(5, 'Дошкольники', 'Как подготовиться к школе ребенку и его родителям: в этом разделе обсуждаем все, что касается детей дошкольного возраста, делимся опытом и узнаем много интересного об этом этапе в жизни ребенка.', 1),
(6, 'Школьники', 'Как помочь ребенку адаптироваться к школе, особенности развития детского организма во время переходного возраста, как решать проблемы и реагировать на успехи - все это вы найдете в разделе для родителей школьников.', 1),
(7, 'Готовим на кухне', 'Как вкусно и здорово накормить всю семью? Делимся рецептами и секретами приготовления в разделе для домашних шеф-поваров.', 2),
(8, 'Ремонт в доме', 'В этом разделе мы собрали всю информацию, которая поможет быстро и профессионально сделать ремонт в доме своими руками. Поделитесь собственным опытом и посмотрите на достижения других.', 2),
(9, 'Домашние хлопоты', 'Обсуждаем науку ведения домашнего хозяйства, учимся все успевать и затрачивать минимум сил для максимального результата. Маленькие секреты больших домашних хлопот.', 2),
(10, 'Сад и огород', 'Как сделать сад отрадой для глаз, а огород - источником вкусных и полезных продуктов? Советы для начинающих садоводов и обсуждения профессионалов.', 2),
(11, 'Наши питомцы', 'Домашние питомцы - источник непередаваемой радости и удовольствия. Как за ними ухаживать и на что обратить внимание хозяевам домашних животных.', 2),
(12, 'Красота и мода', 'Модные тенденции и актуальные тренды, советы по выбору одежды, аксессуаров, макияжа и всего того, что делает нас прекрасными.', 3),
(13, 'Наше здоровье', 'Организм человека - тонкий механизм, требующий особого внимания и аккуратного подхода. В этом разделе собрана информация, которая позволит вам быть всегда здоровыми.', 3),
(14, 'Свадьба', 'День бракосочетания - особый момент в жизни каждого. В этом разделе планируем свадьбу, обсуждаем варианты ее проведения, наряды и традиции, правила застолья и делимся своим опытом!', 4),
(15, 'Отношения в семье', 'Как добиться и сохранить гармонию в отношениях на долгие годы, решить возникающие проблемы и радоваться каждому моменту семейного счастья.', 4),
(16, 'Рукоделие', 'Вязание и шитье, вышивка и лепка, оригами и плетение - есть масса способов заняться рукоделием и добавить в нашу жизнь яркие краски. Здесь мы делимся опытом, осваиваем новые техники и хвастаемся своими творениями.', 5),
(17, 'Цветы в доме', 'Это раздел для тех, кто хочет превратить свой дом в цветущий сад: как разводить комнатные цветы и ухаживать за ними, секреты профессионалов и реальный опыт решения проблем.', 5),
(18, 'Наш автомобиль', 'Практические советы по уходу и эксплуатации легкового автомобиля, ситуации на дороге, рекомендации по выбору автотоваров - все это вы сможете узнать, заглянув в данный раздел.', 5),
(19, 'Рыбалка', 'Тихая охота - рыбалка - это не просто увлечение, а образ жизни. Обсуждаем все премудрости, делимся советами, помогаем новичкам освоить искусство рыбалки и хвастаемся уловом!', 5),
(20, 'Мы путешествуем', 'Путешествия всей семьей - что может быть лучше для интересного и активного отдыха. Читаем информацию, собираемся - и в путь!', 6),
(21, 'Выходные с семьей', 'Иногда стоит отложить все текущие дела и заботы, чтобы собраться на выходные всей семьей. Наш раздел поможет спланировать совместный досуг.', 6),
(22, 'Праздники', 'В этом разделе вы найдете множество интересных идей для праздников: семейных, детский, религиозных.', 6);
");
        try{
            $this->insert('community__forums', array(
                'id'=>38,
                'title'=>'Образование',
            ));
            $this->insert('community__forums', array(
                'id'=>39,
                'title'=>'Наши питомцы',
            ));
            $this->insert('community__forums', array(
                'id'=>40,
                'title'=>'Спорт',
            ));
            $this->insert('community__forums', array(
                'id'=>41,
                'title'=>'Рыбалка и охота',
            ));

        }catch (Exception $e){

        }

        $this->update('community__forums', array('club_id' => 1), 'id=1');
        $this->update('community__forums', array('club_id' => 2), 'id=2');
        $this->update('community__forums', array('club_id' => 2), 'id=3');

        $this->update('community__forums', array('club_id' => 3), 'id=4');
        $this->update('community__forums', array('club_id' => 3), 'id=5');
        $this->update('community__forums', array('club_id' => 3), 'id=6');
        $this->update('community__forums', array('club_id' => 3), 'id=7');

        $this->update('community__forums', array('club_id' => 4), 'id=8');
        $this->update('community__forums', array('club_id' => 4), 'id=9');
        $this->update('community__forums', array('club_id' => 4), 'id=10');
        $this->update('community__forums', array('club_id' => 4), 'id=11');

        $this->update('community__forums', array('club_id' => 5), 'id=12');
        $this->update('community__forums', array('club_id' => 5), 'id=13');
        $this->update('community__forums', array('club_id' => 5), 'id=14');

        $this->update('community__forums', array('club_id' => 6), 'id=15');
        $this->update('community__forums', array('club_id' => 6), 'id=16');
        $this->update('community__forums', array('club_id' => 6), 'id=17');
        $this->update('community__forums', array('club_id' => 6), 'id=18');

        $this->update('community__forums', array('club_id' => 7), 'id=22');
        $this->update('community__forums', array('club_id' => 7), 'id=23');

        $this->update('community__forums', array('club_id' => 8), 'id=26');
        $this->update('community__forums', array('club_id' => 9), 'id=28');
        $this->update('community__forums', array('club_id' => 10), 'id=34');
        $this->update('community__forums', array('club_id' => 11), 'id=39');

        $this->update('community__forums', array('club_id' => 12), 'id=29');
        $this->update('community__forums', array('club_id' => 12), 'id=30');

        $this->update('community__forums', array('club_id' => 13), 'id=33');
        $this->update('community__forums', array('club_id' => 14), 'id=32');
        $this->update('community__forums', array('club_id' => 15), 'id=31');

        $this->update('community__forums', array('club_id' => 16), 'id=24');
        $this->update('community__forums', array('club_id' => 16), 'id=25');

        $this->update('community__forums', array('club_id' => 17), 'id=35');
        $this->update('community__forums', array('club_id' => 18), 'id=27');
        $this->update('community__forums', array('club_id' => 19), 'id=41');
        $this->update('community__forums', array('club_id' => 20), 'id=21');
        $this->update('community__forums', array('club_id' => 20), 'id=19');
        $this->update('community__forums', array('club_id' => 20), 'id=20');
    }

    public function down()
    {
        echo "m130902_105518_fill_club_data does not support migration down.\n";
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