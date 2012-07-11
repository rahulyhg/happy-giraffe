<?php

class RecipeBookDiseaseController extends BController
{
    public $defaultAction = 'admin';
    public $section = 'club';
    public $layout = '//layouts/club';
    public $_class = 'RecipeBookDisease';
    public $authItem = 'editRecipeBook';

    public function actions()
    {
        return array(
            'create' => 'application.components.actions.Create',
            'update' => 'application.components.actions.Update',
            'delete' => 'application.components.actions.Delete',
            'admin' => 'application.components.actions.Admin'
        );
    }

    public function actionAddPhoto()
    {
        $id = Yii::app()->request->getPost('id');
        $model = $this->loadModel($id);

        if (!empty($model->photo))
            $last_photo = $model->photo;

        if (isset($_FILES['photo']) && !empty($model)) {
            $file = CUploadedFile::getInstanceByName('photo');
            if (!in_array($file->extensionName, array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF')))
                Yii::app()->end();

            $photo = new AlbumPhoto();
            $photo->file = $file;
            $photo->title = $model->title;
            $photo->author_id = 1;

            if ($photo->create()) {
                echo "<script type='text/javascript'>
                document.domain = document.location.host;
                </script>";

                $model->photo_id = $photo->id;
                if ($model->save()) {
                    if (isset($last_photo))
                        $last_photo->delete();
                    $response = array(
                        'status' => true,
                        'image' => $photo->getPreviewUrl()
                    );
                } else
                    $response = array('status' => false);
            } else
                $response = array('status' => false);

            echo CJSON::encode($response);
        }
    }
}
