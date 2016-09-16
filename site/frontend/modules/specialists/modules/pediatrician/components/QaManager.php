<?php

namespace site\frontend\modules\specialists\modules\pediatrician\components;
use site\frontend\modules\som\modules\qa\models\QaAnswer;
use site\frontend\modules\som\modules\qa\models\QaCategory;
use site\frontend\modules\som\modules\qa\models\QaQuestion;

/**
 * @author Никита
 * @date 16/08/16
 */
class QaManager
{
    const SKIPS_TABLE = 'specialists__pediatrician_skips';

    public static function getQuestionsDp($userId)
    {
        return new \CActiveDataProvider(QaQuestion::model()->orderDesc()->apiWith('user'), [
            'criteria' => self::getQuestionsCriteria($userId),
        ]);
    }
    
    public static function getQuestionsCount($userId)
    {
        return QaQuestion::model()->count(self::getQuestionsCriteria($userId));
    }

    public static function getAnswersDp($userId)
    {
        return new \CActiveDataProvider(QaAnswer::model()->orderDesc()->apiWith('user'), [
            'criteria' => self::getAnswersCriteria($userId),
        ]);
    }
    
    public static function skip($userId, $questionId)
    {
        return \Yii::app()->db->createCommand()->insert(self::SKIPS_TABLE, [
            'userId' => $userId,
            'questionId' => $questionId,
        ]) > 0;
    }

    /**
     * @param $questionId
     * @param $userId
     * @return QaQuestion|null
     */
    public static function getNextQuestion($questionId, $userId)
    {
        $criteria = self::getQuestionsCriteria($userId);
        $criteria->scopes[] = 'previous';
        return QaQuestion::model()->find($criteria);
    }
    
    protected static function getAnswersCriteria($userId)
    {
        $criteria = new \CDbCriteria();
        $criteria->scopes = ['category' => [self::getCategoryId()]];
        $criteria->with = 'question';
        $criteria->compare('t.authorId', $userId);
        return $criteria;
    }
    
    protected static function getQuestionsCriteria($userId)
    {
        $criteria = new \CDbCriteria();
        $criteria->scopes = ['category' => [self::getCategoryId()]];
        $criteria->select = 't.*';
        $criteria->join = 'LEFT OUTER JOIN ' . QaAnswer::model()->tableName() . ' answers ON answers.questionId = t.id AND answers.authorId IN (SELECT id FROM specialists__profiles)';
        $criteria->group = 't.id';
        $criteria->with = 'category';
        $criteria->addCondition('t.id NOT IN (SELECT questionId FROM ' . self::SKIPS_TABLE . ' WHERE userId = :userId)');
        $criteria->addCondition('answers.id IS NULL');
        $criteria->params[':userId'] = $userId;
        return $criteria;
    }

    protected static function getCategoryId()
    {
        return QaCategory::PEDIATRICIAN_ID;
    }
}