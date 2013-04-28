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
    public static function getFriends($userId, $limit, $online, $listId, $query, $offset)
    {
        $criteria = new CDbCriteria(array(
            'with' => 'friend',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $criteria->compare('t.user_id', $userId);

        if ($online)
            $criteria->compare('friend.online', '1');

        if ($listId)
            $criteria->compare('t.list_id', $listId);

        if ($query) {
            $sCriteria = new CDbCriteria();
            $sCriteria->addSearchCondition('first_name', $query);
            $sCriteria->addSearchCondition('last_name', $query, true, 'OR');
            $criteria->mergeWith($sCriteria);
        }

        return Friend::model()->findAll($criteria);
    }

    public static function getLists($userId)
    {
        return FriendList::model()->with('friendsCount')->findAllByAttributes(array('user_id' => $userId));
    }
}
