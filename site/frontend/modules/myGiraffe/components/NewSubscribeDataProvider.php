<?php

/**
 * @todo временное решение, надо переделывать на нормальные подписки
 */
class NewSubscribeDataProvider
{

    const TYPE_ALL = 1;
    const TYPE_FRIENDS = 2;
    const TYPE_BLOGS = 3;
    const TYPE_COMMUNITY = 4;

    /**
     * Посты для страницы "Мой Жираф"
     *
     * @param int $user_id
     * @param int $type
     * @param int $community_id
     * @return CActiveDataProvider
     */
    public static function getDataProvider($user_id, $type = 1)
    {
        if ($type == self::TYPE_COMMUNITY)
            $criteria = self::getCommunityCriteria($user_id);
        elseif ($type == self::TYPE_FRIENDS)
            $criteria = self::getFriendsCriteria($user_id);
        elseif ($type == self::TYPE_BLOGS)
            $criteria = self::getBlogsCriteria($user_id);
        else
            $criteria = self::getAllContent($user_id);

        return new CActiveDataProvider(\site\frontend\modules\posts\models\Content::model()->orderDesc(), array(
            'criteria' => $criteria,
            'pagination' => array('pageVar' => 'page')
        ));
    }

    public static function getAllContent($user_id)
    {
        $criteria = new CDbCriteria;
        $tags = array();
        $users = array();

        // Получим список подписок на клубы
        $clubs = UserClubSubscription::model()->with('club')->findAllByAttributes(array(
            'user_id' => $user_id,
        ));
        // Конвертируем клубы в теги
        foreach ($clubs as $club) {
            $tags[] = 'Клуб: ' . $club->club->title;
        }
        // Получим список id тегов
        $tagCriteria = new CDbCriteria();
        $tagCriteria->addInCondition('text', $tags);
        $tags = \site\frontend\modules\posts\models\Label::model()->findAll($tagCriteria, array('limit' => 1000));
        $tags = \CHtml::listData($tags, 'id', 'id');
        // Добавим условие по тегам
        $criteria->with['tagModels'] = array('together' => true);
        $criteria->addInCondition('tagModels.labelId', $tags, 'OR');
        // Получим список подписок на блоги
        $users = UserBlogSubscription::getSubUserIds($user_id);
        // Получим список друзей
        $friends = array_keys(CHtml::listData(Friend::model()->findAllByAttributes(array(
                            'user_id' => $user_id,
                                ), array('limit' => 1000)), 'id', 'id'));
        // Добавим условие по автору
        $criteria->addInCondition('t.authorId', CMap::mergeArray($users, $friends), 'OR');

        return $criteria;
    }

    /**
     * Посты друзей
     *
     * @param int $user_id
     * @return CActiveDataProvider
     */
    public static function getFriendsCriteria($user_id)
    {
        $criteria = new CDbCriteria;
        // Получим список друзей
        $friends = array_keys(CHtml::listData(Friend::model()->findAllByAttributes(array('user_id' => $user_id), array('limit' => 1000)), 'friend_id', 'friend_id'));
        // Добавим условие по автору
        $criteria->addInCondition('t.authorId', $friends);

        return $criteria;
    }

    /**
     * @param int $community_id
     * @return mixed
     */
    public static function getCommunityCriteria($user_id)
    {
        $criteria = new CDbCriteria;
        $tags = array();

        // Получим список подписок на клубы
        $clubs = UserClubSubscription::model()->with('club')->findAllByAttributes(array(
            'user_id' => $user_id,
        ));
        // Конвертируем клубы в теги
        foreach ($clubs as $club) {
            $tags[] = 'Клуб: ' . $club->club->title;
        }
        // Получим список id тегов
        $tagCriteria = new CDbCriteria();
        $tagCriteria->addInCondition('text', $tags);
        $tags = \site\frontend\modules\posts\models\Label::model()->findAll($tagCriteria, array('limit' => 1000));
        $tags = \CHtml::listData($tags, 'id', 'id');
        // Добавим условие по тегам
        $criteria->with['tagModels'] = array('together' => true);
        $criteria->addInCondition('tagModels.labelId', $tags);

        return $criteria;
    }

    /**
     * Посты подписок на блоги
     *
     * @param int $user_id
     * @return CActiveDataProvider
     */
    public static function getBlogsCriteria($user_id)
    {
        $criteria = new CDbCriteria;
        // Получим список подписок на блоги
        $users = UserBlogSubscription::getSubUserIds($user_id);
        // Добавим условие по автору
        $criteria->addInCondition('t.authorId', $users);

        return $criteria;
    }

}
