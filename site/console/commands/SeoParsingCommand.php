<?php
/**
 * Author: alexk984
 * Date: 13.03.12
 */

Yii::import('site.seo.models.*');
Yii::import('site.seo.models.mongo.*');
Yii::import('site.common.models.mongo.*');
Yii::import('site.seo.components.*');
Yii::import('site.seo.components.wordstat.*');
Yii::import('site.seo.modules.competitors.models.*');
Yii::import('site.seo.modules.writing.models.*');
Yii::import('site.seo.modules.promotion.models.*');
Yii::import('site.seo.modules.traffic.models.*');
Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
Yii::import('site.frontend.helpers.*');

class SeoParsingCommand extends CConsoleCommand
{
    private $prev_month;
    private $prev_year;

    public function beforeAction($action)
    {
        Yii::import('site.seo.modules.competitors.components.*');
        $last_month = strtotime('last day of -1 month');
        $this->prev_month = '07';
        $this->prev_year = date("Y", $last_month);
        echo $this->prev_month . ' - ' . $this->prev_year . "\n";

        return true;
    }

    public function actionAdd()
    {
        $last_num = SeoUserAttributes::getAttribute('keyword_num', 1);
        echo $last_num . "\n";

        $handle = fopen("/home/giraffe/uniq_590m_ru.txt", "r");
        $i = 0;
        while (!feof($handle)) {
            $i++;
            $keyword = fgets($handle);
            if ($i < $last_num)
                continue;

            Keyword::GetKeyword($keyword, 1);

            if ($i % 10000 == 0)
                SeoUserAttributes::setAttribute('keyword_num', $i, 1);
        }
        fclose($handle);
    }

    public function actionLi($site)
    {
        $last_parsed = SeoUserAttributes::getAttribute('last_li_parsed_' . date("Y-m"), 1);
        if (empty($site)) {
            $parser = new LiParser(false, true);

            if (!empty($last_parsed))
                $sites = Site::model()->findAll('id > ' . $last_parsed . ' AND type = 1 AND url != ""');
            else
                $sites = Site::model()->findAll('type = 1 AND url != ""');

            foreach ($sites as $site) {
                echo $site->id . "\n";
                $parser->start($site->id, $this->prev_year, 1, 7);
                SeoUserAttributes::setAttribute('last_li_parsed_' . date("Y-m"), $site->id, 1);
            }
        } else {
            $parser = new LiParser(true, true);
            $parser->start($site, $this->prev_year, 1, date("n") );
        }
    }

    public function actionMailru($site)
    {
        $last_parsed = SeoUserAttributes::getAttribute('last_mailru_parsed_' . date("Y-m"), 1);
        if (empty($site)) {
            $parser = new MailruParser(false, true);

            if (!empty($last_parsed))
                $sites = Site::model()->findAll('id > ' . $last_parsed . ' AND type=2');
            else
                $sites = Site::model()->findAll('type=2');

            foreach ($sites as $site) {
                $parser->start($site->id, $this->prev_year, $this->prev_month, $this->prev_month);
                SeoUserAttributes::setAttribute('last_mailru_parsed_' . date("Y-m"), $site->id, 1);
            }
        } else {
            $parser = new MailruParser(false, true);
            $parser->start($site, $this->prev_year, $this->prev_month, $this->prev_month);
        }
    }

    public function actionLiKeywords($site)
    {
        $last_parsed = SeoUserAttributes::getAttribute('last_li_parsed_' . date("Y-m-d"), 1);
        $parser = new LiKeywordsParser;

        if (empty($site)) {
            if (!empty($last_parsed))
                $sites = Site::model()->findAll('id > ' . $last_parsed);
            else
                $sites = Site::model()->findAll();

            foreach ($sites as $site) {
                $parser->start($site->id);
                SeoUserAttributes::setAttribute('last_li_parsed_' . date("Y-m-d"), $site->id, 1);
            }
        } else {
            $parser = new LiKeywordsParser();
            $parser->start($site);
        }
    }

    public function actionParseSites($page)
    {
        $parser = new LiSitesParser;
        $parser->start($page);
    }

    public function actionLi2Parse($debug = false)
    {
        $parser = new Li2KeywordsParser(true, $debug);
        $parser->start();
    }

    public function actionLi2Private($debug = false)
    {
        $parser = new Li2KeywordsParser(true, $debug);
        $parser->rus_proxy = false;
        $parser->parse_private = true;
        $parser->period = Li2KeywordsParser::PERIOD_DAY;
        $parser->start();
    }

    public function actionPassword($debug = false)
    {
        $parser = new LiPassword(true, $debug);
        $parser->rus_proxy = false;
        $parser->start();
    }

    public function actionAddLiSite($id){
        $site = LiSite::model()->findByPk($id);
        $exist = Site::model()->findByAttributes(array('url'=>$site->url));
        if ($exist){
            echo "exist\n";
            Yii::app()->end();
        }
        $site2= new Site;
        $site2->name =$site->url;
        $site2->url =$site->url;
        $site2->password =$site->password;
        $site2->type = Site::TYPE_LI;
        if ($site2->save()){
            echo $site2->id."\n";
        }else
            echo "error\n";
    }
}

