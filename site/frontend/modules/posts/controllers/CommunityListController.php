<?php

namespace site\frontend\modules\posts\controllers;

use site\frontend\modules\posts\models\Content;

/**
 * Description of CommunityController
 *
 * @author Кирилл
 */
class CommunityListController extends ListController
{

    public $litePackage = 'clubs';
    public $layout = '/layouts/newCommunityPost';
    protected $_club = null;
    protected $_forum = null;
    protected $_rubric = null;

    public function getClub()
    {
        if (is_null($this->_club)) {
            $id = \Yii::app()->request->getParam('forum_id');
            $this->_forum = \Community::model()->with(array('club', 'club.section'))->findByPk($id);
            $this->_club = $this->_forum->club;
        }

        return $this->_club;
    }

    public function getRubric()
    {
        $id = \Yii::app()->request->getParam('rubric_id');
        if (is_null($this->_rubric) && !is_null($id)) {
            $this->_rubric = \CommunityRubric::model()->findByPk($id);
        }

        return $this->_rubric;
    }

    public function getForum()
    {
        if (is_null($this->_forum)) {
            $this->getClub();
        }
        return $this->_forum;
    }

    public function getTags()
    {
        $tags = array();
        $rubric = $this->getRubric();
        while ($rubric) {
            $tags[] = 'Рубрика: ' . $rubric->title;
            $rubric = $rubric->parent;
        }
        if ($this->getRubric()->community) {
            $tags[] = 'Форум: ' . $this->getRubric()->community->title;
            if ($this->getRubric()->community->club)
                $tags[] = 'Клуб: ' . $this->getRubric()->community->club->title;
            if ($this->getRubric()->community->club && $this->getRubric()->community->club->section)
                $tags[] = 'Секция: ' . $this->getRubric()->community->club->section->title;
        }

        return $tags;
    }

    public function getListDataProvider()
    {
        return new \CActiveDataProvider(Content::model()->byService('oldCommunity')->byTags($this->tags)->orderDesc(), array(
            'pagination' => array(
                'pageSize' => 10,
                'pageVar' => 'CommunityContent_page',
            )
        ));
    }

    public function actionIndex()
    {
        $this->listDataProvider = $this->getListDataProvider();
        $this->render('list');
    }

}
