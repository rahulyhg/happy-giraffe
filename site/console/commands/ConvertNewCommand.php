<?php
/**
 * Author: alexk984
 * Date: 13.03.12
 */

class ConvertNewCommand extends CConsoleCommand
{
    /**
     * вычисление ширины/высоты фоток
     */
    public function actionUpdatePhotos()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 3000;
        $criteria->offset = 0;
        $criteria->condition = 'width IS NULL';

        $models = array(0);
        while (!empty($models)) {
            $models = AlbumPhoto::model()->findAll($criteria);

            foreach ($models as $model)
                $model->save();

            echo AlbumPhoto::model()->count($criteria) . "\n";
        }
    }

    /**
     * Создание фото-постов из постов с галереями
     */
    public function actionConvertPostPhotos()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 1000;
        $criteria->with = array('content');
        //$criteria->condition = 'content.id > 37616';
        $criteria->offset = 0;

        $models = array(0);
        while (!empty($models)) {
            $models = CommunityPost::model()->findAll($criteria);
            foreach ($models as $model){
                if (strpos($model->text, '<img') !== false && strpos($model->text, '<!-- widget:') === false)
                    $model->save();
                echo $model->content_id."\n";
            }

            $criteria->offset += 1000;
            echo $criteria->offset . "\n";
        }
    }

    public function actionConvertPhotoTest($id)
    {
        $model = CommunityPost::model()->findByAttributes(array('content_id' => $id));
        if (strpos($model->text, '<img') !== false && strpos($model->text, '<!-- widget:') === false) {
            $model->save();
        }
    }

    /**
     * пересчитать рейтинг статей, нужен для блока "лучшие записи блога"
     */
    public function actionRating()
    {
        Yii::import('site.common.models.mongo.*');
        Yii::import('site.frontend.extensions.YiiMongoDbSuite.*');
        Yii::import('site.frontend.modules.favourites.models.*');

        $criteria = new CDbCriteria;
        $criteria->limit = 100;
        $criteria->offset = 0;

        $models = array(0);
        while (!empty($models)) {
            $models = CommunityContent::model()->findAll($criteria);
            foreach ($models as $model)
                PostRating::reCalc($model);

            $criteria->offset += 100;
            echo $criteria->offset . "\n";
        }
    }

    /**
     * Установить рубрику для постов у которых её нет
     */
    public function actionSetStatusesRubric()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 1000;
        $criteria->offset = 0;
        $criteria->condition = 'rubric_id IS NULL';

        $models = array(0);
        while (!empty($models)) {
            $models = CommunityContent::model()->resetScope()->findAll($criteria);
            foreach ($models as $model) {
                if (empty($model->rubric_id))
                    $model->rubric_id = CommunityRubric::getDefaultUserRubric($model->author_id);
                if (!empty($model->rubric_id))
                    $model->update(array('rubric_id'));
                else
                    echo 1;
            }

            $criteria->offset += 1000;
            echo $criteria->offset . "\n";
        }
    }

    public function actionFixVideos()
    {
        Yii::import('site.frontend.components.OEmbed');
        Yii::import('site.frontend.components.video.*');

        $criteria = new CDbCriteria();
        $criteria->order = 'id ASC';
        $criteria->limit = 1000;
        $criteria->offset = 0;

        $models = array(0);
        while (! empty($models)) {
            $models = CommunityVideo::model()->findAll($criteria);
            foreach ($models as $model) {
                $video = Video::factory($model->link);
                $model->embed = $video->embed;
                $model->save(true, array('embed'));
            }

            $criteria->offset += 1000;
            echo $criteria->offset . "\n";
        }
    }
}

