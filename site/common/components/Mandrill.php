<?php
/**
 * Author: choo
 * Date: 02.08.2012
 */
Yii::import('site.common.extensions.restcurl.*');

class Mandrill extends CApplicationComponent
{
    public $apiKey;

    public function send($user, $action, $params = array())
    {
        if (is_int($user))
            $user = User::model()->findByPk($user);
        if (!$user instanceof User)
            return false;

        $rest = new RESTClient;
        $rest->initialize(array('server' => 'https://mandrillapp.com/api/1.0/'));
        $generalData = array(
            'key' => $this->apiKey,
            'message' => array(
                'html' => file_get_contents(Yii::getPathOfAlias('site.common.tpl') . DIRECTORY_SEPARATOR . $action . '.php'),
                'from_email' => 'noreply@happy-giraffe.ru',
                'to' => array(
                    array(
                        'email' => $user->email,
                        'name' => $user->fullName,
                    ),
                ),
            ),
        );
        $data = CMap::mergeArray($generalData, $this->$action($user, $params));
        $res = $rest->post('messages/send.json', $data);
        print_r($res);
    }

    public function passwordRecovery($user, $params)
    {
        return array(
            'message' => array(
                'subject' => 'Напоминание пароля',
                'global_merge_vars' => array(
                    array(
                        'name' => 'USERNAME',
                        'content' => $user->fullName,
                    ),
                    array(
                        'name' => 'EMAIL',
                        'content' => $user->email,
                    ),
                    array(
                        'name' => 'PASSWORD',
                        'content' => $params['password'],
                    ),
                ),
            ),
        );
    }
}
