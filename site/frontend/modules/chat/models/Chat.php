<?php

namespace site\frontend\modules\chat\models;

/**
 * @property int $id
 * @property int $created_at
 * @property int $expires_in
 * @property int $limit
 * @property int $type
 *
 * @property \User[] $users
 */
class Chat extends \HActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'chats';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [

        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'users' => [self::MANY_MANY, 'User', 'users_chats(chat_id, user_id)'],
        ];
    }

    public function behaviors()
    {
        return [
            'HTimestampBehavior' => [
                'class' => 'HTimestampBehavior',
                'createAttribute' => 'created_at',
//                'updateAttribute' => 'dtimeUpdate',
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At Time',
            'expires_in' => 'Expires In Time',
            'limit' => 'Limit',
            'Type' => 'Chat Type',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Chat the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @param int $type
     * 
     * @return Chat
     */
    public function byType($type) 
    {
        $this->getDbCriteria()->compare('type', $type);
        
        return $this;
    }
    
    /**
     * @return Chat
     */
    public function aliveOnly()
    {
        $alias = $this->getTableAlias();

        $this->getDbCriteria()->addCondition("({$alias}.expires_in is not null and {$alias}.expires_in < NOW()) or ({$alias}.limit > 0)");
        
        return $this;
    }
    
    /**
     * @return Chat
     */
    public function deadOnly()
    {
        $alias = $this->getTableAlias();

        $this->getDbCriteria()->addCondition("({$alias}.expires_in is not null and {$alias}.expires_in >= NOW()) or ({$alias}.limit = 0)");

        return $this;
    }

    /**
     * @param int $userId
     *
     * @return Chat
     */
    public function byUser($userId)
    {
        $this->getDbCriteria()->addCondition("exists(select user_id from users_chats as uc where uc.user_id = {$userId} limit 1)");

        return $this;
    }
}
