<?php
namespace site\frontend\modules\comments\modules\contest\models;

/**
 * @property int $userId
 * @property int $contestId
 * @property int $score
 * @property int $place
 * @property int $dtimeRegister
 *
 * @author Никита
 * @date 20/02/15
 */


class CommentatorsContestParticipant extends \HActiveRecord
{
    public function tableName()
    {
        return 'commentators__contests_participants';
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'HTimestampBehavior' => array(
                'class' => 'HTimestampBehavior',
                'createAttribute' => 'dtimeRegister',
            ),
        );
    }

    public function contest($contestId)
    {
        $this->getDbCriteria()->compare('t.contestId', $contestId);
        return $this;
    }
}