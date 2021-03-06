<?php

namespace site\frontend\modules\som\modules\activity\commands;

use site\frontend\modules\posts\models\Content;
use site\frontend\modules\som\modules\activity\models\api\Activity;

/**
 * Description of RenewPostActivity
 *
 * @author Кирилл
 */
class RenewActivity extends \CConsoleCommand
{

    public function actionIndex($posts = true, $comments = true, $fromUser = 0)
    {
        \Yii::app()->db->enableSlave = false;
        \Yii::app()->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $dataProvider = new \CActiveDataProvider('User', array('criteria' => array(
                'select' => 'id',
                'condition' => '`id` >= ' . ((int) $fromUser),
                'order' => 'id ASC',
        )));

        $iterator = new \CDataProviderIterator($dataProvider);
        $count = 0;
        foreach ($iterator as $model) {
            echo "\n ----------- \n user " . $model->id . "\n";
            if ($posts) {
                $count+= $this->renewAllUsersPost($model->id);
            }
            if ($comments) {
                $count+= $this->renewAllUsersComment($model->id);
            }
        }
        echo "\ntotal " . $count . " items\n";
    }

    public function actionUser($id, $posts = true, $comments = true)
    {
        if ($posts) {
            $this->renewAllUsersPost($id);
        }
        if ($comments) {
            $this->renewAllUsersComment($id);
        }
    }

    public function renewAllUsersPost($userId, $limit = 100)
    {
        $dataProvider = new \CActiveDataProvider(Content::model()->resetScope()->byAuthor($userId));

        $iterator = new \CDataProviderIterator($dataProvider);
        $count = 0;
        foreach ($iterator as $model) {
            $model->renewActivity();
            $count++;
            echo '.';
            if ($count == $limit) {
                break;
            }
        }

        echo "\n" . $count . " posts\n";

        return $count;
    }

    public function renewAllUsersComment($userId, $limit = 100)
    {
        $criteria = new \CDbCriteria(array(
            'condition' => 'author_id = ' . $userId,
            'order' => 'created DESC',
        ));
        $criteria->addInCondition('entity', \site\frontend\modules\som\modules\activity\behaviors\CommentBehavior::$permittedClasses);
        $dataProvider = new \CActiveDataProvider(\Comment::model()->resetScope(), array(
            'criteria' => $criteria,
        ));

        $iterator = new \CDataProviderIterator($dataProvider);
        $count = 0;
        foreach ($iterator as $model) {
            try {
                $model->renewActivity();
                $count++;
                echo '.';
                if ($count == $limit) {
                    break;
                }
            } catch (\Exception $ex) {
                echo 'f';
            }
        }

        echo "\n" . $count . " comments\n";

        return $count;
    }

}
