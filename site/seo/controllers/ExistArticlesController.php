<?php
/**
 * Author: alexk984
 * Date: 18.05.12
 */
class ExistArticlesController extends SController
{
    public function beforeAction($action)
    {
        if (!Yii::app()->user->checkAccess('admin') && !Yii::app()->user->checkAccess('articles-input'))
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return true;
    }

    public function actionIndex()
    {
        $models = ArticleKeywords::model()->with(array('keywordGroup', 'keywordGroup.keywords'))->findAll(array('order'=>'t.id desc'));
        $keys_count = 0;
        foreach($models as $model){
            $keys_count += count($model->keywordGroup->keywords);
        }
        $this->render('index', compact('models', 'keys_count'));
    }

    public function actionSaveArticleKeys()
    {
        $url = Yii::app()->request->getPost('url');
        preg_match("/\/([\d]+)\/$/", $url, $match);
        $id = $match[1];

        $keywords = Yii::app()->request->getPost('keywords');
        $keywords = explode("\n", $keywords);

        $article = CommunityContent::model()->findByPk($id);
        if ($article === null) {
            $response = array(
                'status' => false,
                'error' => 'Не найдена статья, обратитесь к разработчикам.',
            );
        } else {
            $article_keywords = new ArticleKeywords();
            $article_keywords->entity = 'CommunityContent';
            $article_keywords->entity_id = $article->id;
            $article_keywords->url = $url;

            $group = new KeywordGroup();

            $keyword_models = array();
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    $model = Keywords::GetKeywordForExist($keyword);
                    $keyword_models[] = $model;
                }
            }

            if (empty($keyword_models)) {
                $response = array(
                    'status' => false,
                    'error' => 'Введите кейворды.',
                );
            } else {

                $group->keywords = $keyword_models;
                $group->save();

                $article_keywords->keyword_group_id = $group->id;
                if ($article_keywords->save()){
                    $response = array(
                        'status' => true,
                        'html' => $this->renderPartial('_article', array('model'=>$article_keywords), true),
                        'keysCount'=>count($keyword_models)
                    );
                }else
                    $response = array(
                        'status' => false,
                        'error' => 'Не удалось сохранить статью, обретитесь к разработчикам.',
                    );
            }
        }

        echo CJSON::encode($response);
    }
    
    public function actionValidate(){
        $model = new ArticleKeywords('check');
        $model->attributes = $_POST['ArticleKeywords'];
        $this->performAjaxValidation($model, 'article-form');
    }

    public function performAjaxValidation($model, $formName)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] == $formName){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @param int $id model id
     * @return SeoTask
     * @throws CHttpException
     */
    public function loadTask($id)
    {
        $model = SeoTask::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Запрашиваемая вами страница не найдена.');
        return $model;
    }
}
