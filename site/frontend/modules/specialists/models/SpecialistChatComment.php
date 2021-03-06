<?php

namespace site\frontend\modules\paid\models;
use site\frontend\modules\chat\values\ChatTypes;

/**
 * @property int $user_id
 * @property int $chat_id
 * @property string $text
 *
 * @property \User $user
 * @property \site\frontend\modules\chat\models\Chat $chat
 */
class SpecialistChatComment extends \HActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'specialists__chats_comments';
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
                ['condition' => "deleted = 0 and status = :active and id = :id" /*and specialistInfo is not null and specialistInfo != ''"*/,
                    'params' => [
                        ':active' => \User::STATUS_ACTIVE,
                        ':id' => $this->user_id,
                    ]
                ]
            ],
            ['chat_id', 'exists', 'className' => 'site\frontend\modules\chat\models\Chat', 'caseSensitive' => false, 'criteria' =>
                ['condition' => "id = :id and type = :type",
                    'params' => [
                        ':id' => $this->chat_id,
                        ':type' => ChatTypes::DOCTOR_PRIVATE_CONSULTATION
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
            'chat' => [self::HAS_ONE, 'site\frontend\modules\chat\models\Chat', 'chat_id']
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'chat_id' => 'Chat ID',
            'text' => 'Text',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SpecialistChatComment the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @param int $userId
     *
     * @return SpecialistChatComment
     */
    public function byUserId($userId)
    {
        $this->getDbCriteria()->compare('user_id', $userId);

        return $this;
    }

    /**
     * @param int $chatId
     *
     * @return SpecialistChatComment
     */
    public function byChatId($chatId)
    {
        $this->getDbCriteria()->compare('chat_id', $chatId);

        return $this;
    }
}