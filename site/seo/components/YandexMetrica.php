<?php
/**
 * Author: alexk984
 * Date: 31.05.12
 */
class YandexMetrica
{
    public $token = 'b1cb78403f76432b8a6803dc5e6631b5';
    public $min_visits = 4;
    public $date1;
    public $date2;
    public $week;
    public $year;
    const SE_GOOGLE = 3;
    const SE_YANDEX = 2;

    public $se = array(2, 3);

    function __construct()
    {
        $this->min_visits = Config::getAttribute('minClicks');

        $d = new DateTime();

        //вычисляем даты для парсинга предыдущей недели
        $weekday = $d->format('w');
        $diff = 7 + ($weekday == 0 ? 6 : $weekday - 1); // Monday=0, Sunday=6
        $d->modify("-$diff day");
        $this->date1 = $d->format('Y-m-d');
        $d->modify('+6 day');
        $this->date2 = $d->format('Y-m-d');
        $this->week = date("W") - 1;
        $this->year = date("Y", strtotime('-7 days'));
    }

    public function parseQueries()
    {
        $next = 'http://api-metrika.yandex.ru/stat/sources/phrases?id=11221648&oauth_token=' . $this->token . '&per_page=1000&filter=month&date1=' . $this->date1 . '&date2=' . $this->date2 . '&select_period=week';

        Query::model()->deleteAll();

        while (!empty($next)) {
            $val = $this->loadPage($next);
            $next = $this->getNextLink($val);

            //save to db
            foreach ($val['data'] as $query) {
                $model = new Query();
                $model->attributes = $query;
                $keyword = Keyword::GetKeyword($query['phrase']);
                $model->keyword_id = $keyword->id;
                $model->week = $this->week;
                $model->year = $this->year;
                if ($model->save()) {
                    foreach ($query['search_engines'] as $search_engine) {
                        $se = new QuerySearchEngine();
                        $se->attributes = $search_engine;
                        $se->query_id = $model->id;
                        $se->save();
                    }
                }
            }
        }

        foreach ($this->se as $se)
            $this->parseDataForSE($se);
    }

    public function parseDataForSE($se_id)
    {
        $next = 'http://api-metrika.yandex.ru/stat/sources/phrases?id=11221648&oauth_token=' . $this->token . '&per_page=1000&filter=month&date1=' . $this->date1 . '&date2=' . $this->date2 . '&select_period=month&se_id=' . $se_id;
        while (!empty($next)) {
            $val = $this->loadPage($next);
            $next = $this->getNextLink($val);

            //save to db
            if (is_array($val['data']))
                foreach ($val['data'] as $query) {
                    $model = Query::model()->findByAttributes(array('phrase' => $query['phrase']));
                    if ($model !== null) {
                        $se = QuerySearchEngine::model()->findByAttributes(array(
                            'query_id' => $model->id,
                            'se_id' => $se_id,
                        ));
                        if ($se !== null) {
                            $se->visits = $query['visits'];
                            $se->save();
                        }
                    }
                }
            else
                break;
        }
    }

    public function getNextLink($val)
    {
        if (isset($val['links']['next']))
            $next = $val['links']['next'];
        else
            $next = null;

        return $next;
    }

    public function loadPage($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/x-yametrika+json'));
        curl_exec($ch);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function convertToPageSearchPhrases()
    {
        $pages = QueryPage::model()->findAll();
        foreach ($pages as $page) {
            if (strpos($page->page_url, 'http://www.happy-giraffe.ru') === false)
                continue;

            $keyword = Keyword::GetKeyword($page->query->phrase);
            $model = Page::model()->getOrCreate($page->page_url, $keyword->id);
            $search_phrase = PagesSearchPhrase::model()->findByAttributes(array(
                'page_id' => $model->id,
                'keyword_id' => $keyword->id
            ));
            if ($search_phrase === null) {
                $search_phrase = new PagesSearchPhrase;
                $search_phrase->keyword_id = $keyword->id;
                $search_phrase->page_id = $model->id;
                $search_phrase->save();
            }

            //save visits
            foreach ($this->se as $se) {
                $visits_value = $page->getVisits($se, date("W"), date("Y"));
                $visits = new SearchPhraseVisit;
                $visits->search_phrase_id = $search_phrase->id;
                $visits->se_id = $se;
                $visits->week = date("W");
                $visits->year = date("Y");
                $visits->visits = $visits_value;
                $visits->save();
            }

            //save positions
            /*foreach ($this->se as $se) {
                $position_value = $page->query->;
                $position = new SearchPhrasePosition();
                $position->search_phrase_id = $model->id;
                $position->se_id = $se;
                $position->date = date("Y-m-d H:i:s") ;
                $position->position = $position_value;
                $position->save();
            }*/
        }
    }
}
