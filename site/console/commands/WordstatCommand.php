<?php
/**
 * Author: alexk984
 * Date: 11.10.12
 */

Yii::import('site.seo.models.*');
Yii::import('site.seo.models.mongo.*');
Yii::import('site.seo.components.*');
Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');

class WordstatCommand extends CConsoleCommand
{
    const WORDSTAT_LIMIT = 200;

    /**
     * Удляем из парсинга кеи, для которых частота уже определена и она < LIMIT
     */
    public function actionRemoveLowRanksFromParsing()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->with = array('yandex');
        $criteria->condition = 'yandex.value IS NOT NULL AND yandex.value < ' . self::WORDSTAT_LIMIT;

        $i = 0;
        $models = array(1);
        while (!empty($models)) {
            $models = ParsingKeyword::model()->findAll($criteria);
            foreach ($models as $model) {
                $model->delete();
                $i++;
            }
        }

        echo $i . "\n";
    }

    public function actionAdd()
    {
        $words = 'фелтинг
фильцевание
декорирование
прикладное искусство
народные промыслы
палех
матрешка
фрески
виды кукол
авторские куклы
упаковка
обертка
кружева
плетение
аппликация
хобби
своими руками
квилтинг
вышивание
схемы
рукоделие
канва
ткань
шьем сами
модели
шью
фасон
выкройка
булавка
бурда
вязание
вязка
вязаные вещи
ожерелье
сваровски
украшения
заколка
кольца
скрап
скрапбук
skrapbook
бумага
поделки
елочные игрушки
кракелюр
кракле
пирография
батик
патина
купажирование
отдушка
мыло
мыльная основа
творчество
';
        $words = explode("\n", $words);
        $i = 0;
        foreach ($words as $word) {
            $keywordIds = Keyword::model()->findSimilarIds($word);
            foreach ($keywordIds as $key => $value)
                $this->addKeywordToParsing($key, 5);
            echo $i . "\n";
            $i++;
        }


        $words = 'интерьер
дизайн
витражи
уют
обои настенные
дизайн интерьера
интерьер квартиры
ремонт квартир
перепланировка
стили интерьера
дизайн фото
интерьер фото
ремонт фото
проект дизайн
кухни фото
спальни фото
ванная фото
гостиная фото
прихожая фото
ванная фото
гардеробная фото

интерьер кухни
интерьер спальни
интерьер ванной
интерьер гостиной
интерьер прихожей
интерьер ванной
интерьер гардеробной
интерьер помещений
интерьер комнаты
интерьер дома
интерьер квартир
интерьер коттеджа

дизайн кухни
дизайн спальни
дизайн ванной
дизайн гостиной
дизайн прихожей
дизайн ванной
дизайн гардеробной
дизайн помещений
дизайн комнаты
дизайн дома
дизайн квартир
дизайн коттеджа';
        $words = explode("\n", $words);
        $i = 0;
        foreach ($words as $word)
            if (!empty($word)) {
                $keywordIds = Keyword::model()->findSimilarIds($word);
                foreach ($keywordIds as $key => $value)
                    $this->addKeywordToParsing($key, 6);
                echo $i . "\n";
                $i++;
            }
    }

    private function addKeywordToParsing($keyword_id, $theme)
    {
        $model = ParsingKeyword::model()->findByPk($keyword_id);
        if ($model === null) {
            $model = new ParsingKeyword();
            $model->keyword_id = $keyword_id;
        }
        $model->theme = $theme;
        $model->priority = 10;
        try {
            $model->save();
        } catch (Exception $e) {

        }
    }

    public function actionRemoveParsedKeywords()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->with = array('yandex');
        $criteria->condition = 'yandex.parsed = 1 AND yandex.theme = 0';

        $i = 0;
        $models = array(1);
        while (!empty($models)) {
            $models = ParsingKeyword::model()->findAll($criteria);
            foreach ($models as $model) {
                $model->delete();
                $i++;
            }
        }

        echo $i . "\n";
    }
}