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
        ),
        'bizRule' => null,
        'data' => null
    ),
    'advanced' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Продвинутый пользователь',
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'blocked' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Заблокированный пользователь',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'advanced',
        ),
        'bizRule' => null,
        'data' => null
    ),
);