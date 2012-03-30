<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $external_id
 * @property string $vk_id
 * @property string $nick
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $pic_small
 * @property string $role
 * @property string $link
 * @property int $deleted
 * @property integer $gender
 * @property string $birthday
 * @property string $mail_id
 * @property string $last_active
 * @property integer $online
 * @property string $register_date
 * @property string $login_date
 * @property string $last_ip
 * @property string $relationship_status
 * @property UserAddress $userAddress
 *
 * The followings are the available model relations:
 * @property BagOffer[] $bagOffers
 * @property BagOfferVote[] $bagOfferVotes
 * @property ClubCommunityComment[] $clubCommunityComments
 * @property ClubCommunityContent[] $clubCommunityContents
 * @property ClubContest[] $clubContests
 * @property ClubContestUser[] $clubContestUsers
 * @property ClubContestWinner[] $clubContestWinners
 * @property ClubContestWork[] $clubContestWorks
 * @property ClubContestWorkComment[] $clubContestWorkComments
 * @property ClubPhoto[] $clubPhotos
 * @property ClubPhotoComment[] $clubPhotoComments
 * @property ClubPost[] $clubPosts
 * @property Comment[] $comments
 * @property MenstrualUserCycle[] $menstrualUserCycles
 * @property MessageCache[] $messageCaches
 * @property MessageLog[] $messageLogs
 * @property MessageUser[] $messageUsers
 * @property Name[] $names
 * @property RecipeBookRecipe[] $recipeBookRecipes
 * @property RecipeBookRecipeVote[] $recipeBookRecipeVotes
 * @property UserPointsHistory[] $userPointsHistories
 * @property UserSocialService[] $userSocialServices
 * @property UserViaCommunity[] $userViaCommunities
 * @property VaccineDateVote[] $vaccineDateVotes
 * @property Album[] $albums
 * @property Interest[] interests
 * @property UserPartner partner
 * @property Baby[] babies
 */
class User extends CActiveRecord
{
    public $verifyCode;
    public $current_password;
    public $new_password;
    public $new_password_repeat;
    public $remember;
    public $photo;
    public $assigns;

    public $women_rel = array(
        '1' => 'Замужем',
        '2' => 'Не замужем',
        '3' => 'Вдова',
        '4' => 'Есть друг',
        '5' => 'Невеста',
        '6' => 'Влюблена',
        '7' => 'В поиске',
    );

    public $men_rel = array(
        '1' => 'Женат',
        '2' => 'Не женат',
        '3' => 'Вдовец',
        '4' => 'Есть подруга',
        '5' => 'Жених',
        '6' => 'Влюблен',
        '7' => 'В поиске',
    );

    public $accessLabels = array(
        'all' => 'гости',
        'registered' => 'зарегистрированные пользователи',
        'friends' => 'только друзья',
    );

    public function getAccessLabel()
    {
        return $this->accessLabels[$this->access];
    }

    public function getAge()
    {
        if ($this->birthday === null) return null;

        $birthday = new DateTime($this->birthday);
        $now = new DateTime(date('Y-m-d'));
        $interval = $birthday->diff($now);
        $age = $interval->y;
        return $age;
    }

    public function getAgeSuffix()
    {
        return HDate::ageSuffix($this->age);
    }

    public function getNormalizedAge()
    {
        return $this->age . ' ' . $this->ageSuffix;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            //general
            array('first_name, last_name', 'length', 'max' => 50),
            array('email', 'email'),
            array('password, current_password, new_password, new_password_repeat', 'length', 'min' => 6, 'max' => 12, 'on' => 'signup'),
            array('online, relationship_status', 'numerical', 'integerOnly' => true),
            array('email', 'unique', 'on' => 'signup'),
            //array('password, current_password, new_password, new_password_repeat', 'length', 'min' => 6, 'max' => 12),
            array('gender', 'boolean'),
            array('phone', 'safe'),
            array('settlement_id, deleted', 'numerical', 'integerOnly' => true),
            array('birthday', 'date', 'format' => 'yyyy-MM-dd'),
            array('birthday', 'default', 'value' => NULL),
            array('blocked, login_date, register_date', 'safe'),
            array('mood_id', 'exist', 'className' => 'UserMood', 'attributeName' => 'id'),
            array('profile_access, guestbook_access, im_access', 'in', 'range' => array_keys($this->accessLabels)),
            array('avatar', 'numerical', 'allowEmpty' => true),

            //login
            array('email, password', 'required', 'on' => 'login'),
            array('password', 'passwordValidator', 'on' => 'login'),

            //signup
            array('first_name, email, password, gender', 'required', 'on' => 'signup'),
            array('verifyCode', 'captcha', 'on' => 'signup', 'allowEmpty' => Yii::app()->session->get('service') !== NULL),
            array('email', 'unique', 'on' => 'signup'),
            array('photo', 'safe', 'on' => 'signup'),

            //change_password
            array('new_password', 'required', 'on' => 'change_password'),
            array('current_password', 'validatePassword', 'on' => 'change_password'),
            array('new_password_repeat', 'compare', 'on' => 'change_password', 'compareAttribute' => 'new_password'),
            array('verifyCode', 'captcha', 'on' => 'change_password', 'allowEmpty' => false),
        );
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->password !== $this->hashPassword($this->current_password)) $this->addError('password', 'Текущий пароль введён неверно.');

    }

    public function passwordValidator($attribute, $params)
    {
        if ($this->password == '' || $this->email == '')
            return false;
        $userModel = $this->find(array(
            'condition' => 'email=:email AND password=:password and blocked = 0 and deleted = 0',
            'params' => array(
                ':email' => $_POST['User']['email'],
                ':password' => $this->hashPassword($_POST['User']['password']),
            )));
        if ($userModel) {
            $identity = new UserIdentity($userModel->getAttributes());
            $identity->authenticate();
            if ($identity->errorCode == UserIdentity::ERROR_NONE) {
                $duration = $this->remember == 1 ? 2592000 : 0;
                Yii::app()->user->login($identity);
                $userModel->login_date = date('Y-m-d H:i:s');
                $userModel->last_ip = $_SERVER['REMOTE_ADDR'];
                $userModel->save(false);
            }
            else {
                $this->addError('password', 'Ошибка авторизации');
            }
        }
        else {
            $this->addError('password', 'Ошибка авторизации');
        }
    }

    public function checkUserPassword($attribute, $params)
    {
        $userModel = $this->find(array('condition' => 'email="' . $this->email . '" AND password="' . $this->hashPassword($this->password) . '"'));
        if (!$userModel) {
            $this->addError($attribute, 'Не найден пользователь с таким именем и паролем');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        Yii::import('site.frontend.modules.geo.models.GeoCountry');

        return array(
            'babies' => array(self::HAS_MANY, 'Baby', 'parent_id'),
            'social_services' => array(self::HAS_MANY, 'UserSocialService', 'user_id'),
            'communities' => array(self::MANY_MANY, 'Community', 'user_community(user_id, community_id)'),

            'clubCommunityComments' => array(self::HAS_MANY, 'ClubCommunityComment', 'author_id'),
            'clubCommunityContents' => array(self::HAS_MANY, 'ClubCommunityContent', 'author_id'),
            'clubContests' => array(self::HAS_MANY, 'ClubContest', 'contest_user_id'),
            'clubContestUsers' => array(self::HAS_MANY, 'ClubContestUser', 'user_user_id'),
            'clubContestWinners' => array(self::HAS_MANY, 'ClubContestWinner', 'winner_user_id'),
            'clubContestWorks' => array(self::HAS_MANY, 'ClubContestWork', 'work_user_id'),
            'clubContestWorkComments' => array(self::HAS_MANY, 'ClubContestWorkComment', 'comment_user_id'),
            'clubPhotos' => array(self::HAS_MANY, 'ClubPhoto', 'author_id'),
            'clubPhotoComments' => array(self::HAS_MANY, 'ClubPhotoComment', 'author_id'),
            'clubPosts' => array(self::HAS_MANY, 'ClubPost', 'author_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'author_id'),
            'menstrualUserCycles' => array(self::HAS_MANY, 'MenstrualUserCycle', 'user_id'),
            'messageCaches' => array(self::HAS_MANY, 'MessageCache', 'user_id'),
            'messageLogs' => array(self::HAS_MANY, 'MessageLog', 'user_id'),
            'messageUsers' => array(self::HAS_MANY, 'MessageUser', 'user_id'),
            'names' => array(self::MANY_MANY, 'Name', 'name_likes(user_id, name_id)'),
            'recipeBookRecipes' => array(self::HAS_MANY, 'RecipeBookRecipe', 'user_id'),
            'recipeBookRecipeVotes' => array(self::HAS_MANY, 'RecipeBookRecipeVote', 'user_id'),
            'userPointsHistories' => array(self::HAS_MANY, 'UserPointsHistory', 'user_id'),
            'userSocialServices' => array(self::HAS_MANY, 'UserSocialService', 'user_id'),
            'userViaCommunities' => array(self::HAS_MANY, 'UserViaCommunity', 'user_id'),
            'vaccineDateVotes' => array(self::HAS_MANY, 'VaccineDateVote', 'user_id'),

            'commentsCount' => array(self::STAT, 'Comment', 'author_id'),

            'status' => array(self::HAS_ONE, 'UserStatus', 'user_id', 'order' => 'status.created DESC'),
            'purpose' => array(self::HAS_ONE, 'UserPurpose', 'user_id', 'order' => 'purpose.created DESC'),
            'albums' => array(self::HAS_MANY, 'Album', 'author_id', 'scopes' => array('active')),
            'interests' => array(self::MANY_MANY, 'Interest', 'interest_users(interest_id, user_id)'),
            'mood' => array(self::BELONGS_TO, 'UserMood', 'mood_id'),
            'partner' => array(self::HAS_ONE, 'UserPartner', 'user_id'),

            'blog_rubrics' => array(self::HAS_MANY, 'CommunityRubric', 'user_id'),
            'blogPostsCount' => array(self::STAT, 'CommunityContent', 'author_id', 'join' => 'JOIN club_community_rubric ON t.rubric_id = club_community_rubric.id', 'condition' => 'club_community_rubric.user_id = t.author_id'),

            'communitiesCount' => array(self::STAT, 'Community', 'user_community(user_id, community_id)'),
            'userDialogs' => array(self::HAS_MANY, 'MessageUser', 'user_id'),
            'blogPosts' => array(self::HAS_MANY, 'CommunityContent', 'author_id', 'with' => 'rubric', 'condition' => 'rubric.user_id IS NOT null', 'select' => 'id'),
            'userAddress' => array(self::HAS_ONE, 'UserAddress', 'user_id'),
        );
    }

    public function scopes()
    {
        return array(
            'active' => array(
                'condition' => $this->getTableAlias(false, false) . '.deleted = 0 and ' . $this->getTableAlias(false, false) . '.blocked = 0'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'first_name' => 'Имя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'gender' => 'Пол',
            'phone' => 'Телефон',
            'current_password' => 'Текущий пароль',
            'new_password' => 'Новый пароль',
            'new_password_repeat' => 'Новый пароль ещё раз',
            'remember' => 'Запомнить меня',
            'role' => 'Роль',
            'fullName' => 'Имя пользователя',
            'last_name' => 'Фамилия',
            'assigns' => 'Права',
            'last_active' => 'Последняя активность'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('external_id', $this->external_id);
        $criteria->compare('nick', $this->nick, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('pic_small', $this->pic_small, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord OR $this->scenario == 'change_password') {
                $this->password = $this->hashPassword($this->password);
            }
            return true;
        }
        else
            return false;
    }

    protected function afterSave()
    {
        parent::afterSave();

        foreach ($this->social_services as $service) {
            $service->user_id = $this->id;
            $service->save();
        }
        if ($this->isNewRecord) {
            $this->register_date = date("Y-m-d H:i:s");

            //силнал о новом юзере
            $signal = new UserSignal();
            $signal->user_id = (int)$this->id;
            $signal->signal_type = UserSignal::TYPE_NEW_USER_REGISTER;
            $signal->item_name = 'User';
            $signal->item_id = (int)$this->id;
            $signal->save();

            //рубрика для блога
            $rubric = new CommunityRubric;
            $rubric->name = 'Обо всём';
            $rubric->user_id = $this->id;
            $rubric->save();

            //коммент от веселого жирафа
            $comment = new Comment('giraffe');
            $comment->author_id = 1;
            $comment->entity = get_class($this);
            $comment->entity_id = $this->id;
            $comment->save();
        } else {
            self::clearCache($this->id);
        }
        return true;
    }

    public function beforeDelete()
    {
        UserSignal::closeRemoved($this);
        return false;
    }

    public function hashPassword($password)
    {
        return md5($password);
    }

    public function behaviors()
    {
        return array(
            'behavior_ufiles' => array(
                'class' => 'site.frontend.extensions.ufile.UFileBehavior',
                'fileAttributes' => array(
                    'pic_small' => array(
                        'fileName' => 'upload/avatars/*/<date>-{id}-<name>.<ext>',
                        'fileItems' => array(
                            'ava' => array(
                                'fileHandler' => array('FileHandler', 'run'),
                                'accurate_resize' => array(
                                    'width' => 76,
                                    'height' => 79,
                                ),
                            ),
                            'small' => array(
                                'fileHandler' => array('FileHandler', 'run'),
                                'accurate_resize' => array(
                                    'width' => 25,
                                    'height' => 23,
                                ),
                            ),
                            'big' => array(
                                'fileHandler' => array('FileHandler', 'run'),
                                'accurate_resize' => array(
                                    'width' => 241,
                                    'height' => 225,
                                ),
                            ),
                            'original' => array(
                                'fileHandler' => array('FileHandler', 'run'),
                            ),
                        )
                    ),
                ),
            ),
//			'attribute_set' => array(
//				'class'=>'attribute.AttributeSetBehavior',
//				'table'=>'shop_product_attribute_set',
//				'attribute'=>'product_attribute_set_id',
//			),
            'getUrl' => array(
                'class' => 'site.frontend.extensions.geturl.EGetUrlBehavior',
                'route' => 'product/view',
                'dataField' => array(
                    'id' => 'product_id',
                    'title' => 'product_slug',
                ),
            ),
            'statuses' => array(
                'class' => 'site.frontend.extensions.status.EStatusBehavior',
                // Поле зарезервированное для статуса
                'statusField' => 'product_status',
                'statuses' => array(
                    0 => 'deleted',
                    1 => 'published',
                    2 => 'view only',
                ),
            ),
            'ESaveRelatedBehavior' => array(
                'class' => 'ESaveRelatedBehavior'
            ),
            'ManyManyLinkBehavior' => array(
                'class' => 'site.common.behaviors.ManyManyLinkBehavior',
            ),
        );
    }

    /**
     * @static
     * @return User
     */
    public static function GetCurrentUserWithBabies()
    {
        $user = User::model()->with(array('babies'))->findByPk(Yii::app()->user->id);
        return $user;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @static
     * @param $id
     * @return User
     */
    public static function getUserById($id)
    {
        $user = User::model()->cache(3600 * 24)->findByPk($id);
        return $user;

        //        $value = Yii::app()->cache->get('User_' . $id);
        //        if ($value === false) {
        //            $value = User::model()->findByPk($id);
        //            Yii::app()->cache->set('User_' . $id, $value, 5184000);
        //        }
        //        return $value;
    }

    public static function clearCache($id)
    {
        //        $dep = new CDbCacheDependency('SELECT NOW()');
        //        return User::model()->cache(3600*24, $dep)->findByPk($id);
        $cacheKey = 'yii:dbquery' . Yii::app()->db->connectionString . ':' . Yii::app()->db->username;
        $cacheKey .= ':' . 'SELECT * FROM `user` `t` WHERE `t`.`id`=\'' . $id . '\' LIMIT 1:a:0:{}';
        if (isset(Yii::app()->cache))
            Yii::app()->cache->delete($cacheKey);
    }

    public function getAva($size = 'ava')
    {
        if(!$this->avatar)
            return false;
        if($size != 'big')
            return AlbumPhoto::model()->findByPk($this->avatar)->getAvatarUrl($size);
        else
            return AlbumPhoto::model()->findByPk($this->avatar)->getPreviewUrl(240, 240, Image::WIDTH);
    }

    public function getPartnerPhotoUrl()
    {
        $url = '';
        if (isset($this->partner))
            $url = $this->partner->photo->getUrl('ava');
        return $url;
    }

    public function getDialogUrl()
    {
        if (Yii::app()->user->isGuest || $this->id == Yii::app()->user->id)
            return '#';

        $dialog_id = Im::model()->getDialogIdByUser($this->id);
        if (isset($dialog_id)) {
            $url = Yii::app()->createUrl('/im/default/dialog', array('id' => $dialog_id));
        } else {
            $url = Yii::app()->createUrl('/im/default/create', array('id' => $this->id));
        }

        return $url;
    }

    public function getAssigns()
    {
        $assigns = Yii::app()->authManager->getAuthItems(0, $this->id);
        if (empty($assigns))
            return 'user';
        $res = '';
        foreach ($assigns as $assign) {
            $res .= $assign->description . '<br>';
        }
        return trim($res, '<br>');
    }

    public function getRole()
    {
        $roles = Yii::app()->authManager->getRoles($this->id);
        if (empty($roles))
            return 'user';
        $res = '';
        foreach ($roles as $name => $item) {
            $res .= $name . ', ';
        }
        return trim($res, ', ');
    }

    /**
     * Возвращает приоритет пользователя для окучивания модераторами
     * @return int
     */
    public function getUserPriority()
    {
        //если много пишет, то наивысший приоритет 6
        if (Comment::getUserAvarageCommentsCount($this) > 10)
            return 1;

        //с каждой неделей пребывания на сервере приоритет уменьшается
        $weeks_gone = floor((time() - strtotime($this->register_date)) / 604800);
        if ($weeks_gone < 5)
            return $weeks_gone + 2;
        else
            return 1;
    }

    public function isNewComer()
    {
        //с каждой неделей пребывания на сервере приоритет уменьшается
        $weeks_gone = floor((time() - strtotime($this->register_date)) / 604800);

        if ($this->getRole() == 'user' && $weeks_gone < 5)
            return true;
        return false;
    }

    /**
     * @param $friend_id
     * @return CDbCriteria
     */
    public function getFriendCriteria($friend_id)
    {
        return new CDbCriteria(array(
            'condition' => '(user1_id = :user_id AND user2_id = :friend_id) OR (user1_id = :friend_id AND user2_id = :user_id)',
            'params' => array(':user_id' => $this->id, ':friend_id' => $friend_id),
        ));
    }

    /**
     * @param $friend_id
     * @return bool
     */
    public function addFriend($friend_id)
    {
        if ($this->isFriend($friend_id)) return false;
        $friend = new Friend;
        $friend->user1_id = $this->id;
        $friend->user2_id = $friend_id;
        if ($friend->save()) {
            //добавляем баллы
            Yii::import('site.frontend.modules.scores.models.*');
            UserScores::addScores($this->id, ScoreActions::ACTION_FRIEND, 1, User::getUserById($friend_id));
            UserScores::addScores($friend_id, ScoreActions::ACTION_FRIEND, 1, $this);
            return true;
        }
        return false;
    }

    /**
     * @param $friend_id
     * @return bool
     */
    public function isFriend($friend_id)
    {
        return Friend::model()->count($this->getFriendCriteria($friend_id)) != 0;
    }

    public function isInvitedBy($user_id)
    {
        return FriendRequest::model()->findByAttributes(array(
            'from_id' => $user_id,
            'to_id' => $this->id,
            'status' => 'pending',
        )) !== null;
    }

    /**
     * @param $friend_id
     * @return bool
     */
    public function delFriend($friend_id)
    {
        $res = Friend::model()->deleteAll($this->getFriendCriteria($friend_id));
        if ($res != 0) {
            //вычитаем баллы
            Yii::import('site.frontend.modules.scores.models.*');
            UserScores::removeScores($friend_id, ScoreActions::ACTION_FRIEND, 1, $this);
            UserScores::removeScores($this->id, ScoreActions::ACTION_FRIEND, 1, User::model()->findByPk($friend_id));
            return true;
        }

        return false;
    }

    public function getFriendSelectCriteria()
    {
        return new CDbCriteria(array(
            'join' => 'JOIN ' . Friend::model()->tableName() . ' ON (t.id = friends.user1_id AND friends.user2_id = :user_id) OR (t.id = friends.user2_id AND friends.user1_id = :user_id)',
            'params' => array(':user_id' => $this->id),
        ));
    }

    /**
     * @param string $condition
     * @param array $params
     * @return array
     */
    public function getFriends($condition = '', $params = array())
    {
        $criteria = $this->getFriendSelectCriteria();
        $criteria->mergeWith($this->getCommandBuilder()->createCriteria($condition, $params));

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return int
     */
    public function getFriendsCount($onlineOnly = false)
    {
        $criteria = $this->getFriendSelectCriteria();
        if ($onlineOnly) $criteria->compare('online', true);
        return self::model()->count($criteria);
    }

    public function getFriendRequestsCriteria($direction)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('status', 'pending');

        if ($direction == 'incoming') {
            $criteria->compare('to_id', $this->id);
            $criteria->with = 'from';
        } else {
            $criteria->compare('from_id', $this->id);
            $criteria->with = 'to';
        }

        return $criteria;
    }

    /**
     * @return CActiveDataProvider
     */
    public function getFriendRequests($direction)
    {
        return new CActiveDataProvider('FriendRequest', array(
            'criteria' => $this->getFriendRequestsCriteria($direction),
        ));
    }

    public function getFriendRequestsCount($direction)
    {
        return FriendRequest::model()->count($this->getFriendRequestsCriteria($direction));
    }

    public function getRelashionshipList()
    {
        if ($this->gender == 0)
            return $this->women_rel;
        if ($this->gender == 1)
            return $this->men_rel;
        return array();
    }

    public function getPartnerTitle($id)
    {
        if ($this->gender == 1) {
            if ($id == 1)
                return 'Моя жена:';
            if ($id == 4)
                return 'Моя подруга:';
            if ($id == 5)
                return 'Моя невеста:';
        } else {
            if ($id == 1)
                return 'Мой муж:';
            if ($id == 4)
                return 'Мой друг:';
            if ($id == 5)
                return 'Мой жених:';
        }

        return '';
    }

    public static function relationshipStatusHasPartner($status_id)
    {
        if (in_array($status_id, array(1, 4, 5)))
            return true;
        return false;
    }

    public function calculateAccess($attribute, $user_id)
    {
        switch ($this->$attribute) {
            case 'all':
                return true;
                break;
            case 'registered':
                return $user_id !== null;
                break;
            case 'friends':
                return $this->isFriend($user_id) || $user_id == $this->id;
                break;
        }
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('user/profile', array('user_id' => $this->id));
    }

    public function addCommunity($community_id)
    {
        return Yii::app()->db->createCommand()
            ->insert('user_community', array('user_id' => $this->id, 'community_id' => $community_id)) != 0;
    }

    public function delCommunity($community_id)
    {
        return Yii::app()->db->createCommand()
            ->delete('user_community', 'user_id = :user_id AND community_id = :community_id', array(':user_id' => $this->id, ':community_id' => $community_id)) != 0;
    }

    public function isInCommunity($community_id)
    {
        return Yii::app()->db->createCommand()
            ->select('count(*)')
            ->from('user_community')
            ->where('user_id = :user_id AND community_id = :community_id', array(':user_id' => $this->id, ':community_id' => $community_id))
            ->queryScalar() != 0;
    }

    public function getScores()
    {
        Yii::import('site.frontend.modules.scores.models.*');
        $model = UserScores::model()->with(array('level' => array('select' => array('name'))))->findByPk($this->id);
        if ($model === null) {
            $model = new UserScores;
            $model->user_id = $this->id;
            $model->save();
        }

        return $model;
    }

    public function getUserAddress()
    {
        if ($this->userAddress === null) {
            $address = new UserAddress();
            $address->user_id = $this->id;
            $address->save();
            $this->userAddress = $address;
        }
        return $this->userAddress;
    }

    public function getBlogWidget()
    {
        $criteria = new CDbCriteria(array(
            'order' => new CDbExpression('RAND()'),
            'limit' => 4,
            'with' => array(
                'rubric' => array(
                    'condition' => 'user_id = :user_id',
                    'params' => array(':user_id' => $this->id),
                ),
            ),
        ));

        return CommunityContent::model()->full()->findAll($criteria);
    }
}