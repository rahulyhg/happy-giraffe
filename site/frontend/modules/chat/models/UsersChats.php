<?php

namespace site\frontend\modules\chat\models;

/**
 * @property int $user_id
 * @property int $chat_id
 *
 * @property \User $user
 * @property \site\frontend\modules\chat\models\Chat $chat
 */
class UsersChats extends \HActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users_chats';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['user_id', 'exists', 'className' => 'User', 'caseSensitive' => false, 'criteria' =>
                ['condition' => "deleted = 0 and status = :active and id = :id",
                    'params' => [
                        ':active' => \User::STATUS_ACTIVE,
                        ':id' => $this->user_id,
                    ]
                ]
            ],
            ['chat_id', 'exists', 'className' => 'site\frontend\modules\chat\models\Chat', 'caseSensitive' => false, 'criteria' =>
                ['condition' => "id = :id",
                    'params' => [
                        ':id' => $this->chat_id,
                    ]
                ]
            ],
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
            'user' => [self::HAS_ONE, 'User', 'user_id'],
            'chat' => [self::HAS_ONE, 'site\frontend\modules\chat\models\Chat', 'chat_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User Id',
            'chat_id' => 'Chat Id',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UsersChats the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}