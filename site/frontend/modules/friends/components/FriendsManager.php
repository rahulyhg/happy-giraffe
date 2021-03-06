<?php
/**
 * Created by JetBrains PhpStorm.
 * User: solivager
 * Date: 4/27/13
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */
class FriendsManager
{
    const FRIENDS_PER_PAGE = 15;

    public static function getFriends($userId, $online, $onlyNew, $listId, $query, $offset)
    {
        $criteria = self::getCriteria($userId, $online, $onlyNew, $listId, $query);
        $criteria->limit = ($offset == 0) ? self::FRIENDS_PER_PAGE - 1 : self::FRIENDS_PER_PAGE;
        $criteria->offset = $offset;

        return Friend::model()->findAll($criteria);
    }

    public static function getFriendsCount($userId, $online, $onlyNew, $listId, $query, $offset)
    {
        $criteria = self::getCriteria($userId, $online, $onlyNew, $listId, $query);

        return Friend::model()->count($criteria);
    }

    protected static function getCriteria($userId, $online, $onlyNew, $listId, $query)
    {
        $criteria = new CDbCriteria(array(
            'select' => '*, 0 AS pCount, 0 AS bCount',
            'with' => array(
                'friend',
                'friend.babies',
                'friend.partner',
            ),
            'order' => 't.id ASC',
        ));

        $criteria->compare('t.user_id', $userId);

        if ($online)
            $criteria->compare('friend.online', '1');

        if ($listId)
            $criteria->compare('t.list_id', $listId);

        if ($onlyNew)
            $criteria->addCondition('t.created >= DATE_ADD(CURDATE(), INTERVAL -3 DAY)');

        if ($query) {
            $sCriteria = new CDbCriteria();
            $sCriteria->addSearchCondition('first_name', $query);
            $sCriteria->addSearchCondition('last_name', $query, true, 'OR');
            $sCriteria->addSearchCondition(new CDbExpression('CONCAT_WS(\' \', first_name, last_name)'), $query, true, 'OR');
            $sCriteria->addSearchCondition(new CDbExpression('CONCAT_WS(\' \', last_name, first_name)'), $query, true, 'OR');
            $criteria->mergeWith($sCriteria);
        }

        return $criteria;
    }

    public static function getLists($userId)
    {
        return FriendList::model()->with('friendsCount')->findAllByAttributes(array('user_id' => $userId));
    }

    /**
     * @param User $user
     * @param bool $isFriend
     * @return array
     */
    public static function userToJson($user, $isFriend = false)
    {
        return array(
            'id' => $user->id,
            'online' => (bool)$user->online,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'ava' => $user->getAvatarUrl(Avatar::SIZE_LARGE),
            'age' => $user->normalizedAge,
            'location' => ($user->address->country_id !== null) ? Yii::app()->controller->renderPartial('application.modules.friends.views._location', array('data' => $user), true) : null,
            'family' => null,
            'isFriend' => $isFriend,
            'gender' => $user->gender,
            'photoCount' => (int)$user->getPhotosCount(),
            'blogPostsCount' => (int)$user->blogPostsCount
        );
    }

    /**
     * @param User $user
     * @param bool $isFriend
     * @return array
     */
    public static function userToJsonNoCalculation($user, $isFriend = false)
    {
        return array(
            'id' => $user->id,
            'online' => (bool)$user->online,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'ava' => $user->getAvatarUrl(Avatar::SIZE_LARGE),
            'age' => $user->normalizedAge,
            'location' => null,
            'family' => null,
            'isFriend' => $isFriend,
            'gender' => $user->gender,
            'photoCount' => 0,
            'blogPostsCount' => (int)$user->blogPostsCount
        );
    }
}
