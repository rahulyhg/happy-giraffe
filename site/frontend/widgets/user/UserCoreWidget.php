<?php

class UserCoreWidget extends CWidget
{
    /**
     * @var User
     */
    public $user;

    protected $isMyProfile;
    protected $visible = true;

    public function init()
    {
        $this->isMyProfile = $this->user->id == Yii::app()->user->id;
    }

    public function run()
    {
        $this->render(get_class($this), array(
            'user' => $this->user,
            'isMyProfile' => $this->isMyProfile,
            'visible' => $this->visible,
        ));
    }
}
