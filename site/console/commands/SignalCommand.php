<?php
/**
 * User: alexk984
 * Date: 10.03.12
 *
 */
class SignalCommand extends CConsoleCommand
{
    public $moderators = array();

    /**
     * Если модератор за 5 имнут не выполнил задание, отменяем его.
     */
    public function actionIndex()
    {
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.common.models.mongo.UserSignal');
        Yii::import('site.frontend.modules.signal.models.*');

        UserSignalResponse::CheckLate();
    }

    public function actionFriendInvites()
    {
        $this->loadModerators();
        $new_users = $this->getNewUsers();

        foreach ($new_users as $user_id) {
            if (rand(0, $this->getNum(3)) == 1) {
                $moder = $this->getModerator($user_id);
                if ($moder != null) {
                    $friendRequest = new FriendRequest();
                    $friendRequest->from_id = $moder;
                    $friendRequest->to_id = $user_id;
                    $friendRequest->save();
                }
            }
        }
    }

    public function getNewUsers()
    {
        $end_date = date("Y-m-d H:i:s", strtotime('-7 days'));
        return Yii::app()->db->createCommand()
            ->select('id')
            ->from('users')
            ->where('register_date > :date', array(':date' => $end_date))
            ->queryColumn();

    }

    public function getModerator($user_id)
    {
        shuffle($this->moderators);

        $friends = Yii::app()->db->createCommand()
            ->select('user1_id')
            ->from('friends')
            ->where('user2_id = :user_id', array(':user_id' => $user_id))
            ->union(
            Yii::app()->db->createCommand()
                ->select('user2_id')
                ->from('friends')
                ->where('user1_id = :user_id', array(':user_id' => $user_id))
                ->text
        )
            ->queryColumn();

        foreach ($this->moderators as $moder_id) {
            if (!in_array($moder_id, $friends))
                return $moder_id;
        }

        return null;
    }

    public function getNum($number_friends)
    {
        return round(144 / $number_friends);
    }

    public function loadModerators()
    {
        $this->moderators = Yii::app()->db->createCommand()
            ->select('userid')
            ->from('auth__assignments')
            ->where('itemname = "moderator"')
            ->queryColumn();
    }

    public function actionCommentatorsStats()
    {
        Yii::import('site.frontend.modules.signal.models.*');
        Yii::import('site.frontend.modules.signal.components.*');
        Yii::import('site.common.models.mongo.*');
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.frontend.modules.im.models.*');

        $month = CommentatorsMonthStats::model()->find(new EMongoCriteria(array(
            'conditions' => array(
                'period' => array('==' => date("Y-m"))
            ),
        )));
        if ($month === null) {
            $month = new CommentatorsMonthStats;
            $month->period = date("Y-m");
        }
        $month->calculate();
        $month->save();
    }

    public function actionCommentatorsEndMonth()
    {
        $month = CommentatorsMonthStats::model()->find(new EMongoCriteria(array(
            'conditions' => array(
                'period' => array('==' => date("Y-m", strtotime('-10 days')))
            ),
        )));
        $month->calculate();
        $month->save();
    }

    public function actionTest()
    {
        $period = date("Y-m");
        Yii::import('site.frontend.extensions.GoogleAnalytics');
        echo Yii::app()->params['gaPass'];
        $ga = new GoogleAnalytics('alexk984@gmail.com', Yii::app()->params['gaPass']);
        $ga->setProfile('ga:53688414');
        $ga->setDateRange($period . '-01', $period . '-30');
        try {
            $report = $ga->getReport(array(
                'metrics' => urlencode('ga:visitors'),
                'filters' => urlencode('ga:pagePath=~' . '/user/15322/blog/*'),
            ));
        } catch (Exception $err) {
            var_dump($err->getMessage());
            Yii::app()->end();
        }

        var_dump($report['']['ga:visitors']);
    }

    public function actionSetStatus($user, $date, $status)
    {
        Yii::import('site.frontend.modules.signal.models.*');
        Yii::import('site.frontend.modules.signal.components.*');
        Yii::import('site.common.models.mongo.*');
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.frontend.modules.im.models.*');

        $user = CommentatorWork::getUser((int)$user);
        $user->getDay($date)->status = (int)$status;
        $user->save();
    }

    public function actionSetCreated()
    {
        Yii::import('site.frontend.modules.signal.models.*');
        Yii::import('site.frontend.modules.signal.components.*');
        Yii::import('site.common.models.mongo.*');
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.frontend.modules.im.models.*');

        $users = CommentatorWork::model()->findAll();
        foreach ($users as $user){
            if (in_array($user->user_id, array(15468, 15472)))
                $user->created = time();
            else
                $user->created = strtotime('-5 days');
            $user->save();
        }
    }
}
