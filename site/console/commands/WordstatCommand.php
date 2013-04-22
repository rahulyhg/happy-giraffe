<?php
/**
 * Author: alexk984
 * Date: 11.10.12
 */

Yii::import('site.seo.models.*');
Yii::import('site.seo.models.mongo.*');
Yii::import('site.seo.components.*');
Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
Yii::import('site.seo.components.wordstat.*');

class WordstatCommand extends CConsoleCommand
{
    const WORDSTAT_LIMIT = 200;

    public function actionAddCompetitors()
    {
        $keywords = Yii::app()->db_seo->createCommand('select distinct(keyword_id) from sites__keywords_visits ')->queryColumn();
        echo count($keywords);
        foreach ($keywords as $keyword_id) {

        }
    }

    public function actionAddKeywordsFromFile()
    {
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.common.models.mongo.*');

        $path = Yii::app()->params['keywords_path'];
        $handle = @fopen($path, "r");
        $i = 0;
        $start_line = UserAttributes::get(1, 'start_file_line', 3800000);
        while (($buffer = fgets($handle)) !== false) {
            $i++;
            if ($i < $start_line)
                continue;

            $keyword = trim(substr($buffer, 0, strpos($buffer, ',')));
            $keyword_model = Keyword::model()->findByAttributes(array('name' => $keyword));
            if ($keyword_model === null) {
                $keyword_model = new Keyword();
                $keyword_model->name = $keyword;
                try {
                    $keyword_model->save();
                    #TODO add to parsing queue
                    //ParsingKeyword::addNewKeyword($keyword_model);
                } catch (Exception $e) {
                }
            }
            if ($i % 10000 == 0) {
                echo $i . "\n";
                UserAttributes::set(1, 'start_file_line', $i);
            }
        }
        fclose($handle);
    }

    public function actionFixPriority($i = 0)
    {
        for ($i = 0; $i < 515; $i++) {
            $ids = 1;
            $j = 0;
            while (!empty($ids)) {
                $ids = Yii::app()->db_keywords->createCommand()
                    ->select('id')
                    ->from('keywords')
                    ->where('wordstat >= 100 AND status IS NULL AND id >= ' . ($i * 1000000) . ' AND id <' . (($i + 1) * 1000000))
                    ->limit(1000)
                    ->offset($j * 1000)
                    ->queryColumn();

                if (!empty($ids))
                    Yii::app()->db_keywords->createCommand()->update('parsing_keywords', array('priority' => 201),
                        'keyword_id IN (' . implode(',', $ids) . ')');
                $j++;
            }
            echo $i . "\n";
        }
    }

    public function actionFix2()
    {
        $deleted = 0;
        for ($i = 0; $i < 120; $i++) {
            $ids = Yii::app()->db_seo->createCommand()
                ->selectDistinct('keyword_id')
                ->from('sites__keywords_visits')
                ->limit(10000)
                ->offset(10000 * $i - $deleted)
                ->queryColumn();

            foreach ($ids as $id) {
                $exist = Yii::app()->db_keywords->createCommand()->select('id')->from('keywords')->where('id=' . $id)->queryScalar();
                if (empty($exist)) {
                    Yii::app()->db_seo->createCommand()->delete('sites__keywords_visits', 'keyword_id=' . $id);
                    $deleted++;
                }
            }

            echo $deleted . "\n";
        }
    }

    public function actionPutTask()
    {
        $job_provider = new WordstatTaskCreator;
        $job_provider->start();
    }

    public function actionSimple(){
        $p = new WordstatParser();
        $p->start();
    }

    public function actionAddSimpleParsing(){
        WordstatParsingTask::getInstance()->addAllKeywordsToParsing();
    }

    private $collection;

    public function actionTest(){
        $mongo = new Mongo('mongodb://localhost');
        $mongo->connect();
        $this->collection = $mongo->selectCollection('parsing', 'simple_parsing');
        echo $this->collection->remove(array('id' => 63312236));
    }
}