<<<<<<< HEAD
<?php

class LinkingController extends SController
{
    public $pageTitle = 'Перелинковка';

    public function beforeAction($action)
    {
        if (!Yii::app()->user->checkAccess('admin') && !Yii::app()->user->checkAccess('superuser'))
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return true;
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView($id, $selected_phrase_id = null)
    {
        $page = $this->loadPage($id);

        $this->render('view', compact('page'));
    }

    public function actionAdd()
    {
        $phrase = $this->loadPhrase(Yii::app()->request->getPost('phrase_id'));
        $page_from = $this->loadPage(Yii::app()->request->getPost('page_id'));
        $keyword_id = Yii::app()->request->getPost('keyword_id');

        $link = new InnerLink();
        $link->page_id = $page_from->id;
        $link->page_to_id = $phrase->page_id;
        $link->phrase_id = $phrase->id;
        $link->keyword_id = $keyword_id;

        echo CJSON::encode(array('status' => $link->save()));
    }

    public function actionPhraseInfo()
    {
        Yii::import('site.frontend.extensions.phpQuery.phpQuery');

        $parser = new SimilarArticlesParser;
        $phrase = $this->loadPhrase(Yii::app()->request->getPost('phrase_id'));
        $pages = $parser->getArticles($phrase->keyword->name);
        if (empty($pages)){
            //если яндекс не нашел статьи по запросу - выводим статьи из рубрики
            $url = $phrase->page->getRubricUrl();
            $pages = $parser->getArticles($url);
        }
        //удалим текущий
        foreach($pages as $key=>$page)
            if ($page->id == $phrase->page_id)
                unset($pages[$key]);

        $keywords = $phrase->getSimilarKeywords();

        $this->renderPartial('_phrase_view', compact('pages', 'keywords'));
    }

    /**
     * @param int $id model id
     * @return Keyword
     * @throws CHttpException
     */
    public function loadKeyword($id)
    {
        $model = Keyword::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return $model;
    }

    /**
     * @param int $id model id
     * @return PagesSearchPhrase
     * @throws CHttpException
     */
    public function loadPhrase($id)
    {
        $model = PagesSearchPhrase::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return $model;
    }

    /**
     * @param int $id model id
     * @return Page
     * @throws CHttpException
     */
    public function loadPage($id)
    {
        $model = Page::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return $model;
    }
=======
<?php

class LinkingController extends SController
{
    public $pageTitle = 'Перелинковка';

    public function beforeAction($action)
    {
        if (!Yii::app()->user->checkAccess('admin') && !Yii::app()->user->checkAccess('superuser'))
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return true;
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionGo()
    {
        $url = Yii::app()->request->getPost('url');
        preg_match("/\/([\d]+)\/$/", $url, $match);
        $id = $match[1];

        $article = CommunityContent::model()->findByPk($id);
        if ($article === null) {
            $response = array(
                'status' => false,
                'error' => 'Не найдена статья, обратитесь к разработчикам.',
            );
        } else {
            $article_keyword = Page::model()->findByAttributes(array(
                'entity' => 'CommunityContent',
                'entity_id' => $id,
            ));

            if ($article_keyword === null)
                $response = array(
                    'status' => false,
                    'error' => 'Не введены ключевые слова статьи.',
                );
            else {
                if (!isset($article_keyword->keywordGroup) || empty($article_keyword->keywordGroup->keywords))
                    $response = array(
                        'status' => false,
                        'error' => 'Не введены ключевые слова статьи.',
                    );
                else {
                    $linkingPage = LinkingPages::model()->findByAttributes(array(
                        'entity' => 'CommunityContent',
                        'entity_id' => $id
                    ));
                    if ($linkingPage === null) {
                        $linkingPage = new LinkingPages;
                        $linkingPage->entity = 'CommunityContent';
                        $linkingPage->entity_id = $id;
                        $linkingPage->url = $article->url;
                        $linkingPage->save();
                    }

                    $response = array(
                        'status' => true,
                        'html' => $this->renderPartial('_donors', array(
                            'article_keyword'=>$article_keyword,
                            'linkingPage'=>$linkingPage
                        ), true)
                    );
                }
            }
        }

        echo CJSON::encode($response);
    }


    public function actionAdd(){
        $id = Yii::app()->request->getPost('id');
        $article_from_id = Yii::app()->request->getPost('articleFromId');
        $keyword_id = Yii::app()->request->getPost('keyword_id');

        $linkingPageTo = LinkingPages::model()->findByPk($id);
        $article_from = CommunityContent::model()->findByPk($article_from_id);

        $linkingPageFrom = LinkingPages::model()->findByPk(array(
            'entity' => 'CommunityContent',
            'entity_id' => $article_from_id
        ));
        if ($linkingPageFrom === null) {
            $linkingPageFrom = new LinkingPages;
            $linkingPageFrom->entity = 'CommunityContent';
            $linkingPageFrom->entity_id = $article_from->id;
            $linkingPageFrom->url = $article_from->url;
            $linkingPageFrom->save();
        }

        $link = new LinkingPagesPages;
        $link->page_id = $linkingPageFrom->id;
        $link->linkto_page_id = $linkingPageTo->id;
        $link->keyword_id = $keyword_id;

        echo CJSON::encode(array('status' => $link->save()));
    }

    function getmicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
>>>>>>> bcbba80b7c977381bce69db138494cf1f6a997e8
}