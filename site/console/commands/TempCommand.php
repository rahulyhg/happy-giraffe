<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mikita
 * Date: 9/26/13
 * Time: 7:43 PM
 * To change this template use File | Settings | File Templates.
 */

class TempCommand extends CConsoleCommand
{
    public function actionCheatPampers()
    {
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.common.models.mongo.PageView');
        while (true) {
            PageView::model()->cheat('/community/10/forum/post/101319/', 0, 1);
            sleep(60);
        }
    }

    public function actionBabies()
    {
        $dp = new CActiveDataProvider('Baby');
        $iterator = new CDataProviderIterator($dp, 1000);
        foreach ($iterator as $baby)
            $baby->save(false);
    }

    public function actionHh()
    {
        $hh = new HhParser();
        $hh->run();
    }
}