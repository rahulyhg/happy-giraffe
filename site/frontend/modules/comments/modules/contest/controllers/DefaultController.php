<?php

namespace site\frontend\modules\comments\modules\contest\controllers;

use site\frontend\modules\comments\modules\contest\components\ContestManager;
use site\frontend\modules\comments\modules\contest\models\CommentatorsContest;
use site\frontend\modules\comments\modules\contest\models\CommentatorsContestParticipant;
use site\frontend\modules\comments\modules\contest\models\CommentatorsContestComment;
use site\frontend\modules\posts\models\Content;
use site\frontend\modules\quests\components\QuestsManager;
use site\frontend\modules\quests\components\QuestTypes;
use site\frontend\modules\analytics\models\PageView;
use site\frontend\modules\quests\models\Quest;

/**
 * @property CommentatorsContest $contest
 * @private array clubsFilter;
 */
class DefaultController extends \LiteController
{
    public $layout = '/layout';
    public $litePackage = 'contest_commentator';
    public $bodyClass = 'body_competition';
    public $contest;

    private $clubsFilter;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions' => array('my', 'quests'),
                'users' => array('?'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        $this->loadContest();
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->render('/index');
    }

    public function actionRules()
    {
        $this->render('/rules');
    }

    /**
     * @param string $type community|blog
     *
     * @throws \HttpException
     */
    public function actionQuests($type = 'community')
    {
        // TODO: добавить проверку на дропнутый квест при получении поста, когда будет
        /**
         * @var CommentatorsContestParticipant $participant
         */
        $participant = CommentatorsContestParticipant::model()
            ->byUser(\Yii::app()->user->id)
            ->byContest($this->contest->id)
            ->find();

        if (($settings = $participant->getSettingArray()) && isset($settings['community_filter'])) {
            $clubs = explode(',', $settings['community_filter']);
            $clubsCount = count($clubs);

            if (count($clubs) > 0) {
                $this->clubsFilter = $clubs;
            }
        }

        if ($type == 'community') {
            $model = Content::model()
                ->byService(Content::COMMUNITY_SERVICE)
                ->withoutUserComments(\Yii::app()->user->id);

            if ($clubsCount > 0) {
                $model->byClubs($clubs);
            }
        } else if ($type == 'blog') {
            $model = Content::model()
                ->byService(Content::BLOG_SERVICE)
                ->withoutUserComments(\Yii::app()->user->id);
        } else {
            throw new \HttpException(404);
        }

        $posts = $model->orderDesc()
            ->findAll(array(
            'limit' => 10
        ));

        $title = 'Прокомментировать пост ' . ($type == 'blog' ? 'в блоге' : 'на форуме');

        foreach ($posts as $post) {
            $post->views = PageView::getModel($post->url)->visits;
            QuestsManager::addQuest(
                \Yii::app()->user->id,
                QuestTypes::COMMENT_POST,
                $post,
                array(),
                null,
                $title,
                $title
            );
        }

        $this->addSocialQuests();

        $socialQuests = Quest::model()
            ->byUser(\Yii::app()->user->id)
            ->byType(QuestTypes::POST_TO_WALL)
            ->byModel((new \ReflectionClass($this->contest))->getShortName(), $this->contest->id)
            ->findAll();

        $this->render('/quests', array(
            'type' => $type,
            'posts' => $posts,
            'clubsCount' => (isset($clubsCount) && $clubsCount != 0)
                ? $clubsCount
                : \CommunityClub::model()->count(),
            'clubs' => \CommunityClub::model()->findAll(),
            'social' => $socialQuests,
        ));
    }

    /**
     * @param int $clubId
     *
     * @return bool
     */
    public function isCheckedClub($clubId)
    {
        if (!$this->clubsFilter) {
            return true;
        }

        return in_array($clubId, $this->clubsFilter);
    }

    private function addSocialQuests()
    {
        $socials = array(
            'ok' => 'одноклассники',
            'vk' => 'вконтакте',
            'fb' => 'фейсбук',
        );

        $open = 'Пригласить в конкурс пользователей из ';

        foreach ($socials as $alias => $name) {
            QuestsManager::addQuest(
                \Yii::app()->user->id,
                QuestTypes::POST_TO_WALL,
                $this->contest,
                array(
                    'social_service' => $alias,
                ),
                null,
                $open . $name,
                $open . $name
            );
        }
    }

    /**
     * @param string $service
     * @param Quest[] $quests
     *
     * @return bool
     */
    public function checkSocialService($service, $quests)
    {
        foreach ($quests as $quest) {
            if(!(isset($quest->settings))) {
                continue;
            }

            $settings = \CJSON::decode($quest->settings);

            if (isset($settings['social_service']) && $settings['social_service'] == $service) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param int $contestId
     */
    public function actionWinners($contestId = null)
    {
        /**
         * @var CommentatorsContest[] $contests
         */
        $contests = CommentatorsContest::model()
            ->findAll(array(
                'order' => 'id DESC',
                'limit' => 4,
            ));

        if (!$contestId) {
            $contestId = !\Yii::app()->user->isGuest ? $contests[0]->id : $contests[1]->id;
        }

        $this->render('/winners', array(
            'contests' => $contests,
            'winners' => $this->getWinners($contestId),
            'contestId' => $contestId,
        ));
    }

    private function getWinners($contestId)
    {
        return CommentatorsContestParticipant::model()
            ->byContest($contestId)
            ->orderByScore()
            ->findAll(array(
                'limit' => 10,
        ));
    }

    public function actionMy()
    {
        $participant = CommentatorsContestParticipant::model()
            ->byContest($this->contest->id)
            ->byUser(\Yii::app()->user->id)
            ->with('user')
            ->find();

        $comments = CommentatorsContestComment::model()
            ->byContest($this->contest->id)
            ->byParticipant($participant->id)
            ->with('comment')
            ->findAll(array(
                'limit' => 5,
            ));

        $this->render('/my', array(
            'comments' => $comments,
            'participant' => $participant,
        ));
    }

    public function actionPulse()
    {
        $comments = array();

        /**
         * @var CommentatorsContestComment[] $contestComments
         */
        $contestComments = CommentatorsContestComment::model()
            ->orderDesc()
            ->byContest($this->contest->id)
            ->with('comment')
            ->findAll(array(
                'limit' => 10,
            ));

        foreach ($contestComments as $c) {
            $comments[] = $c->comment;
        }

        $participantsCount = CommentatorsContestParticipant::model()
            ->byContest($this->contest->id)
            ->count();

        $commentsCount = CommentatorsContestComment::model()
            ->byContest($this->contest->id)
            ->count();

        $this->render('/pulse', array(
            'comments' => $comments,
            'participantsCount' => $participantsCount,
            'commentsCount' => $commentsCount,
        ));
    }

    protected function loadContest()
    {
        $this->contest = ContestManager::getCurrentActive();
        if (!$this->contest) {
            throw new \HttpException(404);
        }
    }
}