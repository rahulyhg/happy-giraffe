<?php
/**
 * Author: alexk984
 * Date: 13.03.12
 */

Yii::import('site.seo.models.*');
Yii::import('site.seo.models.mongo.*');
Yii::import('site.common.models.mongo.*');
Yii::import('site.seo.components.*');
Yii::import('site.seo.modules.competitors.models.*');
Yii::import('site.seo.modules.writing.models.*');
Yii::import('site.seo.modules.promotion.models.*');
Yii::import('site.seo.modules.traffic.models.*');
Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
Yii::import('site.frontend.helpers.*');

class SeoParsingCommand extends CConsoleCommand
{
    public function beforeAction($action)
    {
        Yii::import('site.seo.modules.competitors.components.*');

        return true;
    }

    public function actionWordstat($mode = 0)
    {
        $parser = new WordstatParser();
        $parser->start($mode);
    }

    public function actionLi($site)
    {
        $last_parsed = SeoUserAttributes::getAttribute('last_li_parsed_'.date("Y-m") , 1);
        if (empty($site)) {
            $parser = new LiParser;

            if (!empty($last_parsed))
                $sites = Site::model()->findAll('id > '.$last_parsed);
            else
                $sites = Site::model()->findAll();

            foreach ($sites as $site) {
                $parser->start($site->id, 2012, 1, 1);

                SeoUserAttributes::setAttribute('last_li_parsed_'.date("Y-m") , $site->id, 1);
            }
        } else {
            $parser = new LiParser;
            $parser->start($site, 2012, 1, 1);
        }
    }

    public function actionLiKeywords($site){
        $last_parsed = SeoUserAttributes::getAttribute('last_li_parsed_'.date("Y-m-d") , 1);
        $parser = new LiKeywordsParser;

        if (empty($site)) {
            if (!empty($last_parsed))
                $sites = Site::model()->findAll('id > '.$last_parsed);
            else
                $sites = Site::model()->findAll();

            foreach ($sites as $site) {
                $parser->start($site->id);
                SeoUserAttributes::setAttribute('last_li_parsed_'.date("Y-m-d"), $site->id, 1);
            }
        } else {
            $parser = new LiKeywordsParser();
            $parser->start($site);
        }
    }

    public function actionParseSites($page){
        $parser = new LiSitesParser;
        $parser->start($page);
    }

    public function actionLi2Parse($debug = false){
        $parser = new Li2KeywordsParser(false, $debug);
        $parser->start();
    }

    public function actionLi2Private($debug = false){
        $parser = new Li2KeywordsParser(true, $debug);
        $parser->rus_proxy = false;
        $parser->parse_private = true;
        $parser->start();
    }

    public function actionPassword($debug = false){
        $parser = new LiPassword(true, $debug);
        $parser->rus_proxy = false;
        $parser->start();
    }
}

