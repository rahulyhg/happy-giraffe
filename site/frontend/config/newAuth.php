<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Гость',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => array(
            'guest',
            'manageOwnContent',
            'createComment',
            'manageOwnPhotoCollection',
            'createPhotoAlbum',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Модератор',
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'manageOwnContent' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Управление своим контентом (где автор)',
        'children' => array(
            'manageComment',
        ),
        'bizRule' => 'return $params["entity"]->author_id == \Yii::app()->user->id;',
        'data' => null
    ),
    'manageComment' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Управление комментариями',
        'children' => array(
            'updateComment',
            'removeComment',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'createComment' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Добавление комментария',
        'bizRule' => null,
        'data' => null
    ),
    'updateComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Редактирование комментария',
        'bizRule' => null,
        'data' => null
    ),
    'removeComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление комментария',
        'children' => array(
            'manageComment',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'createPhotoAlbum' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Создание альбома',
        'bizRule' => null,
        'data' => null,
    ),
    'managePhotoAlbum' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Управление альбомами',
        'children' => array(
            'editPhotoAlbum',
            'removePhotoAlbum',
            'restorePhotoAlbum',
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'editPhotoAlbum' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Редактирование комментария',
        'bizRule' => null,
        'data' => null,
    ),
    'removePhotoAlbum' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление комментария',
        'bizRule' => null,
        'data' => null,
    ),
    'restorePhotoAlbum' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление комментария',
        'bizRule' => null,
        'data' => null,
    ),
    'manageOwnPhotoCollection' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Управление своей фотоколлекцией',
        'children' => array(
            'addPhotos',
            'sortPhotoCollection',
            'setCover',
            'communicateBetweenOwnCollections',
        ),
        'bizRule' => 'return $params["collection"]->getOwner()->id == \Yii::app()->user->id;',
        'data' => null,
    ),
    'sortPhotoCollection' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Сортировка коллекции',
        'bizRule' => null,
        'data' => null,
    ),
    'addPhotos' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Перемещение аттачей',
        'bizRule' => null,
        'data' => null,
    ),
    'setCover' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение обложки',
        'bizRule' => null,
        'data' => null,
    ),
    'communicateBetweenOwnCollections' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Перемещение аттачей',
        'children' => array(
            'moveAttaches',
        ),
        'bizRule' => 'return $params["collection"]->getOwner()->id == \Yii::app()->user->id && $params["destinationCollection"]->getOwner()->id == \Yii::app()->user->id;',
        'data' => null,
    ),
    'moveAttaches' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Перемещение аттачей',
        'bizRule' => null,
        'data' => null,
    ),
);