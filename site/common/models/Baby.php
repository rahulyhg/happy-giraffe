<?php

/**
 * This is the model class for table "user__users_babies".
 *
 * The followings are the available columns in table 'user__users_babies':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $age_group
 * @property string $name
 * @property string $birthday
 * @property integer $sex
 * @property string $notice
 * @property string $type
 *
 * The followings are the available model relations:
 * @property VaccineDateVote[] $vaccineDateVotes
 * @property AttachPhoto $photos
 * @property int $photosCount
 */
class Baby extends HActiveRecord
{
    const TYPE_WAIT = 1;
    const TYPE_PLANNING = 2;
    const TYPE_TWINS = 3;

    const SEX_GIRL = 0;
    const SEX_BOY = 1;
    const SEX_UNDEFINED = 2;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user__users_babies';
    }

    public function relations()
    {
        return array(
            'parent' => array(self::BELONGS_TO, 'User', 'parent_id'),
            'photos' => array(self::HAS_MANY, 'AttachPhoto', 'entity_id', 'with' => 'photo', 'on' => '`photo`.`removed` = 0 AND entity = :modelName', 'params' => array(':modelName' => get_class($this))),
            'photosCount' => array(self::STAT, 'AttachPhoto', 'entity_id', 'condition' => 'entity =: modelName', 'params' => array(':modelName' => get_class($this))),
            'randomPhoto' => array(self::HAS_ONE, 'AttachPhoto', 'entity_id', 'with' => 'photo', 'on' => '`photo`.`removed` = 0 AND entity = :modelName', 'params' => array(':modelName' => get_class($this)), 'order' => new CDbExpression('RAND()')),
        );
    }

    public function rules()
    {
        return array(
            array('age_group', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 5),
            array('name', 'length', 'max' => 50),
            array('birthday', 'date', 'format' => 'yyyy-MM-dd'),
            array('birthday', 'babyBirthday'),
            array('sex', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 2),
            array('notice', 'length', 'max' => 100),
            array('type', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 3),
            array('main_photo_id', 'exist', 'className' => 'AlbumPhoto', 'attributeName' => 'id'),

//            array('parent_id', 'required'),
//            array('name', 'required', 'on'=>'realBaby'),
//            array('birthday', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
//            array('parent_id, age_group', 'numerical', 'integerOnly'=>true),
//            array('sex', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 2),
//            array('name', 'length', 'max'=>255),
//            array('notice', 'length', 'max'=>100),
//            array('birthday', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Родитель',
            'age_group' => 'Возрастная группа',
            'name' => 'Имя',
            'birthday' => 'День рождения',
            'sex' => 'Пол',
        );
    }

    /*public function getAge()
    {
        if ($this->birthday === null) return null;

        $date1 = new DateTime($this->birthday);
        $date2 = new DateTime(date('Y-m-d'));
        $interval = $date1->diff($date2);
        return $interval->y;
    }*/

    public function getTextAge()
    {
        if ($this->birthday === null)
            return '';

        if ($this->type == self::TYPE_WAIT || $this->type == self::TYPE_TWINS)
            return $this->getPregnancyWeeks();

        $date1 = new DateTime($this->birthday);
        $date2 = new DateTime(date('Y-m-d'));
        $interval = $date1->diff($date2);

        if ($interval->days == 0)
            return 'Сегодня';

        if ($interval->days < 7)
            return $interval->d . ' ' . Str::GenerateNoun(array('день', 'дня', 'дней'), $interval->d);

        if ($interval->m == 0 && $interval->y == 0) {
            $weeks = floor($interval->d / 7);
            return $weeks . ' ' . Str::GenerateNoun(array('неделя', 'недели', 'недель'), $weeks);
        }

        if ($interval->y == 0)
            return $interval->m . ' ' . Str::GenerateNoun(array('месяц', 'месяца', 'месяцев'), $interval->m);

        if ($interval->y < 3)
            return $interval->y . ' ' . Str::GenerateNoun(array('год', 'года', 'лет'), $interval->y) . ' ' . ($interval->m > 0 ? $interval->m . ' ' . Str::GenerateNoun(array('месяц', 'месяца', 'месяцев'), $interval->m) : '');

        return $interval->y . ' ' . Str::GenerateNoun(array('год', 'года', 'лет'), $interval->y);
    }

    public function getAgeImageUrl()
    {
        /*if ($this->birthday === null)
            return '/images/age_02.gif';
        $age = $this->getAge();
        if ($age <= 1)
            return '/images/age_02.gif';
        if ($age <= 3)
            return '/images/age_03.gif';
        if ($age <= 7)
            return '/images/age_04.gif';

        return '/images/age_05.gif';*/
        return '';
    }

    public function getGenderString(){
        if ($this->sex == 1)
            return 'Мой сын';
        if ($this->sex == 0)
            return 'Моя дочь';

        return '';
    }

    public function getBirthdayDates()
    {
        return null;
    }

    public function getAge()
    {
        /*if ($this->birthday === null) return '';

        $date1 = new DateTime($this->birthday);
        $date2 = new DateTime(date('Y-m-d'));
        $interval = $date1->diff($date2);
        return $interval->y.' '.Str::GenerateNoun(array('год', 'года', 'лет'), $interval->y);*/
        return $this->getTextAge();
    }

    public function getBDatePart($part)
    {
        if (empty($this->birthday))
            return '';
        return date($part, strtotime($this->birthday));
    }

    public function getRandomPhotoUrl()
    {
        if (count($this->photos) == 0)
            return '';

        $i = rand(0, count($this->photos)-1);
        return $this->photos[$i]->photo->getPreviewUrl(180, 180);
    }

    protected function beforeSave()
    {
        if ($this->birthday !== null) {
            $date1 = new DateTime($this->birthday);
            $date2 = new DateTime(date('Y-m-d'));
            $interval = $date1->diff($date2);
            if ($interval->y < 1)
                $this->age_group = 0;
            if ($interval->y >= 1 && $interval->y < 3)
                $this->age_group = 1;
            if ($interval->y >= 3 && $interval->y < 6)
                $this->age_group = 2;
            if ($interval->y >= 6 && $interval->y < 12)
                $this->age_group = 3;
            if ($interval->y >= 12 && $interval->y < 18)
                $this->age_group = 4;
            if ($interval->y >= 18)
                $this->age_group = 5;
        }

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        parent::afterSave();

        if ($this->isNewRecord) {
            UserAction::model()->add($this->parent_id, UserAction::USER_ACTION_FAMILY_UPDATED, array('model' => $this));
        }

        User::model()->UpdateUser($this->parent_id);
    }

    public function getPregnancyWeeks()
    {
        if ($this->type != self::TYPE_WAIT)
            return false;

        $now = new DateTime();
        $conception = new DateTime($this->birthday);
        $conception->modify('-9 month');
        $interval = $now->diff($conception);
        return ceil($interval->days / 7);
    }

    public function getFullYears()
    {
        $now = new DateTime();
        $bd = new DateTime($this->birthday);
        $interval = $now->diff($bd);
        return $interval->y;
    }

    public function babyBirthday($attribute, $params)
    {
        if ($this->type === null) {
            $date1 = new DateTime($this->birthday);
            $date2 = new DateTime(date('Y-m-d'));
            $interval = $date1->diff($date2);
            if ($interval->invert == 1)
                $this->addError($attribute, 'Неверная дата рождения.');
        }
        if ($this->type == self::TYPE_WAIT || $this->type == self::TYPE_TWINS) {
            $date1 = new DateTime(date('Y-m-d'));
            $date2 = new DateTime($this->birthday);
            $interval = $date1->diff($date2);
            if ($interval->invert == 1 || $interval->y !== 0 || $interval->m > 9)
                $this->addError($attribute, 'Неверная планируемая дата родов.');
        }
    }
}