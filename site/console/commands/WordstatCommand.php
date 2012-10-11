<?php
/**
 * Author: alexk984
 * Date: 11.10.12
 */

Yii::import('site.seo.models.*');
Yii::import('site.seo.models.mongo.*');
Yii::import('site.seo.components.*');
Yii::import('site.seo.modules.competitors.models.*');
Yii::import('site.seo.modules.writing.models.*');
Yii::import('site.seo.modules.promotion.models.*');
Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');

class WordstatCommand extends CConsoleCommand
{
    const WORDSTAT_LIMIT = 300;

    /**
     * Удляем из парсинга кеи, для которых частота уже определена и она < LIMIT
     */
    public function actionRemoveLowRanksFromParsing()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->with = array('yandex');
        $criteria->condition = 'yandex.value IS NOT NULL AND yandex.value < '.self::WORDSTAT_LIMIT;

        echo ParsingKeyword::model()->count($criteria);
    }
}