<?php
/**
 * @author Никита
 * @date 21/04/15
 */

namespace site\frontend\modules\posts\modules\myGiraffe\controllers;


use site\frontend\modules\posts\modules\myGiraffe\models\FeedItem;

class DefaultController extends \LiteController
{
    public $litePackage = 'posts_user';

    public function actionIndex($filter = 'all')
    {
        $dp = FeedItem::model()->getListDataProvider(\Yii::app()->user->id, $filter);
        $this->render('index', compact('dp'));
    }
}