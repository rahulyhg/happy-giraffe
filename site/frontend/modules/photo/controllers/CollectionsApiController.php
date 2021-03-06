<?php
/**
 * Created by PhpStorm.
 * User: mikita
 * Date: 23/09/14
 * Time: 16:05
 */

namespace site\frontend\modules\photo\controllers;
use site\frontend\modules\photo\components\observers\PhotoCollectionObserver;
use site\frontend\components\api\ApiController;
use site\frontend\modules\photo\models\PhotoCollection;

class CollectionsApiController extends ApiController
{
    public function actions()
    {
        return \CMap::mergeArray(parent::actions(), array(
            'get' => 'site\frontend\components\api\PackAction',
        ));
    }

    public function packGet($id)
    {
        $model = $this->getModel('\site\frontend\modules\photo\models\PhotoCollection', $id);
        $this->success = $model !== null;
        if ($this->success) {
            $this->data = $model;
        }
    }

    public function actionListAttaches($collectionId, $page, $pageSize)
    {
        $offset = $page * $pageSize;
        $length = $pageSize;

        $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId);
        $this->success = true;
        $this->data['attaches'] = $collection->observer->getSlice($offset, $length, false);
        $this->data['isLast'] = ($offset + $length) >= $collection->observer->getCount();
    }

    public function actionGetAttaches($collectionId, $offset, $length = null, $circular = false)
    {
        $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId);
        $this->success = true;
        $this->data['attaches'] = $collection->observer->getSlice($offset, $length, $circular);
    }

    public function actionGetByUser($userId)
    {
        /** @var \User $user */
        $user = $this->getModel('\User', $userId);
        $this->success = true;
        $this->data = array(
            'all' => $user->getPhotoCollection('default'),
            'unsorted' => $user->getPhotoCollection('unsorted'),
        );
    }

    public function actionSetCover($collectionId, $attachId)
    {
        /** @var \site\frontend\modules\photo\models\PhotoCollection $collection */
        //$collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId, 'setCover');
        $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId, false);
        $attach = $this->getModel('site\frontend\modules\photo\models\PhotoAttach', $attachId);
        $this->success = $collection->setCover($attach) && $collection->save(true, array('cover_id'));
    }

    public function actionAddPhotos(array $photosIds, $collectionId = null)
    {
        /** @var \site\frontend\modules\photo\models\PhotoCollection $collection */
        if ($collectionId === null) {
            $collection = new PhotoCollection();
            $collection->save();
        } else {
            $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId, 'addPhotos');
        }
        $collection->attachPhotos($photosIds);
        $this->success = true;
        $this->data = $collection;
    }

    public function actionSortAttaches($collectionId, array $attachesIds)
    {
        /** @var \site\frontend\modules\photo\models\PhotoCollection $collection */
        $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $collectionId, 'sortPhotoCollection');
        $collection->sortAttaches($attachesIds);
        $this->success = true;
    }

    public function actionMoveAttaches($sourceCollectionId, $destinationCollectionId, array $attachesIds)
    {
        /** @var \site\frontend\modules\photo\models\PhotoCollection $collection */
        $collection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $sourceCollectionId, 'moveAttaches');
        $destinationCollection = $this->getModel('site\frontend\modules\photo\models\PhotoCollection', $destinationCollectionId, 'moveAttaches');
        $this->success = $collection->moveAttaches($destinationCollection, $attachesIds);
    }
} 