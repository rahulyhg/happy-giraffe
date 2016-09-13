<?php

namespace site\frontend\components\api\models;

/**
 * Модель, реализующая доступ к API, согласно описанию https://happygiraffe.atlassian.net/wiki/pages/viewpage.action?pageId=2195460
 *
 * @property-read int $id Id пользователя
 * @property-read string $firstName Имя
 * @property-read string $lastName Фамилия
 * @property-read int $avatarId Id аватара
 * @property-read int $gender Пол (0 - Ж, 1 - М)
 * @property-read bool $isOnline true, если пользователь online, иначе - false
 * @property-read string $profileUrl Ссылка на профиль
 * @property-read string $avatarUrl Ссылка на аватар, запрошенного размера
 * @property-read array $avatarInfo массив с размерами аватаров
 * @property-read string $publicChannel Публичный канал пользователя
 * @author Кирилл
 */
class User extends ApiModel
{

    public $api = 'users';

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }   
    
    /**
     * Формат имени для анонимного юзера
     * 
     * @author Sergey Gubarev
     * @return string
     */
    public function getAnonName()
    {   
        $model = \UserAddress::model()->find('user_id=:user_id', [':user_id' => $this->id]);
        
        $stringData = [];
        
        $stringData[] = $this->firstName;
        
        if ($model->city)
        {
            $stringData[] = $model->city->name;
        }
        
        return implode(', ', $stringData);
    }
    
    /**
     * 
     * @param string $className
     * @return \site\frontend\components\api\models\User
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeNames()
    {
        return array(
            'id',
            'firstName',
            'lastName',
            'birthday',
            'avatarId',
            'gender',
            'isOnline',
            'profileUrl',
            'avatarUrl',
            'avatarInfo',
            'publicChannel',
            'specInfo',
            'specialistInfo',
        );
    }

    public function actionAttributes()
    {
        return array(
            'insert' => false,
            'update' => false,
            'remove' => false,
            'restore' => false,
        );
    }

}

?>
