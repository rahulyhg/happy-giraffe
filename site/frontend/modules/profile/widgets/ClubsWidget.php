<?php

class ClubsWidget extends UserCoreWidget
{
    public $data = array();
    public $size = 'Small';

    public function init()
    {
        parent::init();
        $this->visible = $this->isMyProfile || !empty($this->user->communities);
        if ($this->visible)
            $this->data = $this->getUserCommunitiesData();

        $this->viewFile = get_class($this).$this->size;
        Yii::app()->clientScript->registerPackage('ko_profile');
    }

    /**
     * Возвращает информацию о сообществах
     * @return array
     */
    private function getUserCommunitiesData()
    {
        $data = array();
        foreach ($this->user->communitySubscriptions as $subscription) {
            $data [] = array(
                'id' => $subscription->community->id,
                'title' => $subscription->community->title,
                'have' => ($this->isMyProfile) ? true : ((Yii::app()->user->isGuest) ? false : UserCommunitySubscription::subscribed($this->user->id, $subscription->community->id)),
            );
        }
        return $data;
    }
}
