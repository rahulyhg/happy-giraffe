<?php

/**
 * Временный контроллер, для реализации форм добавления/редактирования статей в старом интерфейсе
 *
 * @author Кирилл
 */
class TmpController extends HController
{

    public $layout = '//layouts/main';

    public function getUser()
    {
        return Yii::app()->user->model;
    }

    public function actionIndex($id = null, $type = null)
    {
        /* (с) site.frontend.blog.controllers.DefaultController::actionForm */
        if (!($id xor $type)) {
            throw new CHttpException(400);
        }

        if (Yii::app()->user->isGuest)
            throw new CHttpException(403);

        if ($id) {
            $model = BlogContent::model()->findByPk($id);
            if (!$model) {
                throw new CHttpException(404);
            }
            $slaveModel = $model->getContent();
        } else {
            $model = new BlogContent('default');
            $model->type_id = $type;
            $slug = $model->type->slug;
            $slaveModelName = 'Community' . ucfirst($slug);
            $slaveModel = new $slaveModelName();
        }

        if (!$model->isNewRecord && !$model->canEdit()) {
            throw new CHttpException(403);
        }

        $rubricsList = array_map(function ($rubric) {
            return array(
                'id' => $rubric->id,
                'title' => $rubric->title,
            );
        }, Yii::app()->user->model->blog_rubrics);

        $json = array(
            'title' => (string) $model->title,
            'privacy' => (int) $model->privacy,
            'text' => (string) $slaveModel->text,
            'rubricsList' => $rubricsList,
            'selectedRubric' => $id === null ? null : $model->rubric_id,
        );

        if ($model->type_id == CommunityContent::TYPE_STATUS) {
            $json['moods'] = array_map(function ($mood) {
                return array(
                    'id' => (int) $mood->id,
                    'title' => (string) $mood->title,
                );
            }, UserMood::model()->findAll(array('order' => 'id ASC')));
            $json['mood_id'] = $slaveModel->mood_id;
        }

        if ($model->type_id == CommunityContent::TYPE_PHOTO_POST) {
            if ($model->isNewRecord)
                $json['photos'] = array();
            else
                $json['photos'] = $model->getContent()->getPhotoPostData();
            $json['albumsList'] = array_map(function ($album) {
                return array(
                    'id' => $album->id,
                    'title' => $album->title,
                );
            }, $this->user->simpleAlbums);
        }

        if ($model->type_id == CommunityContent::TYPE_VIDEO) {
            if ($model->isNewRecord) {
                $json['link'] = '';
                $json['embed'] = null;
            } else {
                $json['link'] = $model->video->link;
                $json['embed'] = $model->video->embed;
            }
        }

        $club_id = null;

        $this->render('index', compact('model', 'slaveModel', 'json', 'club_id'));
    }

    public function actionFavourites($entity, $entityId)
    {
        $result = array();
        $model = array(
            'entity' => $entity,
            'entityId' => $entityId,
        );
        if (Yii::app()->user->model->checkAuthItem('manageFavourites')) {
            if ($entity == 'SimpleRecipe' || $entity == 'MultivarkaRecipe') {
                $result[] = array('class' => 'social', 'title' => 'Посты в соцсети', 'num' => Favourites::BLOCK_SOCIAL_NETWORKS, 'active' => Favourites::inFavourites($model, Favourites::BLOCK_SOCIAL_NETWORKS));
            } else {
                $result[] = array('class' => 'interest', 'title' => 'На главную', 'num' => Favourites::BLOCK_INTERESTING, 'active' => Favourites::inFavourites($model, Favourites::BLOCK_INTERESTING));
                $result[] = array('class' => 'social', 'title' => 'Посты в соцсети', 'num' => Favourites::BLOCK_SOCIAL_NETWORKS, 'active' => Favourites::inFavourites($model, Favourites::BLOCK_SOCIAL_NETWORKS));
                $result[] = array('class' => 'mail', 'title' => 'Посты в рассылку', 'num' => Favourites::WEEKLY_MAIL, 'active' => Favourites::inFavourites($model, Favourites::WEEKLY_MAIL));
            }
        }

        if ($entity == 'CommunityContent' && Yii::app()->user->model->checkAuthItem('clubFavourites')) {
            $result[] = array('class' => 'interest', 'title' => 'Интересное в клубах', 'num' => Favourites::CLUB_MORE, 'active' => Favourites::inFavourites($model, Favourites::CLUB_MORE));
        }
        echo CJSON::encode($result);
    }

}

?>