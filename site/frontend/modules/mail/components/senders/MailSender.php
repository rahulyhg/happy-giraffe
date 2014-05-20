<?php
/**
 * Рассыльщик
 *
 * Отвечает главным образом за то, КОМУ отправлять письма, собирает необходимые для генерации данные, создает модели
 * сообщений и передает их "почтальону" MailPostman
 */

register_shutdown_function( "fatal_handler" );

function fatal_handler() {
    $isError = false;

    $error = error_get_last();
    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];
    }

    switch($error['type']){
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
            $isError = true;
            break;
    }

    if ($isError) {
        print_r($error);
        die;
    }
}

abstract class MailSender extends CComponent
{
    const DEBUG_DEVELOPMENT = 0;
    const DEBUG_TESTING = 1;
    const DEBUG_PRODUCTION = 2;

    public $type;
    protected $lastDeliveryTimestamp;
    protected $debugMode = self::DEBUG_DEVELOPMENT;

    /**
     * Обработка конкретно взятого пользователя
     *
     * @param User $user
     * @return mixed
     */
    protected abstract function process(User $user);

    /**
     * Отправить рассылку всем пользователям, для которых она может быть отправлена
     *
     * @return mixed
     */
    public function sendAll()
    {
        try {
            if ($this->beforeSend()) {
                $this->iterate();
            }
        } catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'mail');
        }
    }

    public function preview(User $user)
    {
        /** @var MailPostman $postman */
        $postman = Yii::app()->postman;
        $mode = $postman->mode;
        $postman->mode = MailPostman::MODE_ECHO;

        try {
            if ($this->beforeSend()) {
                $this->process($user);
            }
        } catch (Exception $e) {
            header('Content-Type: text/html; charset=utf-8');
            echo $e->getMessage();
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'mail');
        }

        $postman->mode = $mode;
    }

    protected function getDeliveryType()
    {
        return $this->type;
    }

    /**
     * Процедура итерации
     *
     * Вынесена отдельно, чтобы можно было удобно переопределять метод sendAll
     */
    protected function iterate()
    {
        try {
            $iterator = $this->getIterator();
            foreach ($iterator as $user) {
                $this->process($user);
            }
        } catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'mail');
        }
    }

    /**
     * Действия, которые должны быть совершены перед рассылкой и "обходом" пользователей. Рассылка будет сделана только
     * в том случае, если данный момент возвращает истину
     *
     * @return bool
     */
    protected function beforeSend()
    {
        $lastDelivery = MailSendersHistory::model()->getLastDelivery($this->getDeliveryType());
        $this->lastDeliveryTimestamp = ($lastDelivery === null) ? null : $lastDelivery->timestamp;

        $newDelivery = new MailSendersHistory();
        $newDelivery->type = $this->type;
        $newDelivery->save();

        return true;
    }

    /**
     * Возвращает итератор на основе критерии
     *
     * @return CDataProviderIterator
     */
    protected function getIterator()
    {
        $dp = new CActiveDataProvider('User', array(
            'criteria' => $this->getUsersCriteria(),
        ));
        return new CDataProviderIterator($dp, 1000);
    }

    /**
     * Критерия для выборки пользователей
     *
     * Позволяет уже на этапе выборке отсечь лишних пользователей, что оптимизирует генерацию рассылки и упрощает
     * сам код рассылки (нет необходимости проверять значения полей, по которым итератор уже отфильтрован)
     *
     * @return CDbCriteria
     */
    protected function getUsersCriteria()
    {
        $criteria = new CDbCriteria();

        switch ($this->debugMode) {
            case self::DEBUG_DEVELOPMENT:
                $criteria->compare('t.id', 12936);
                break;
            case self::DEBUG_TESTING:
                $criteria->join = 'INNER JOIN auth__assignments aa ON aa.userid = t.id AND aa.itemname = :itemname';
                $criteria->params[':itemname'] = 'tester';
                break;
        }

        return $criteria;
    }


}

