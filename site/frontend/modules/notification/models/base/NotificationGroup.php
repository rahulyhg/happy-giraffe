<?php
/**
 * Class NotificationNewComment
 *
 * Уведомление пользователю о новом комментарии
 *
 * @author Alex Kireev <alexk984@gmail.com>
 */
class NotificationGroup extends Notification
{
    public $entity;
    public $entity_id;
    public $unread_model_ids = array();
    public $read_model_ids = array();

    /**
     * Создаем уведомление о новом комментарии. Если уведомление к этому посту уже создавалось и еще не было
     * прочитано, то добавляем в него новый комментарий и увеличиваем кол-во нотификаций
     *
     * @param $model_id
     */
    protected function create($model_id)
    {
        $this->ensureIndex();
        $exist = $this->getCollection()->findOne(array(
            'type' => $this->type,
            'recipient_id' => (int)$this->recipient_id,
            'read' => 0,
            'entity' => $this->entity,
            'entity_id' => (int)$this->entity_id,
        ));

        if ($exist) {
            //если такая модель уже есть в списке ничего не меняем
            if (in_array($model_id, $exist['unread_model_ids']))
                return;
            $this->update($exist, $model_id);
        } else
            $this->insert($model_id);

        $this->sendSignal();
    }

    /**
     * Добавление в существующее уведомление информации о новом комментарии/лайке к этой записи/фото
     *
     * @param $exist
     * @param $model_id
     */
    private function update($exist, $model_id)
    {
        $this->getCollection()->findAndModify(
            array("_id" => $exist['_id']),
            array(
                '$set' => array("updated" => time()),
                '$inc' => array("count" => 1),
                '$push' => array("unread_model_ids" => (int)$model_id),
            ),
            null
        );
    }

    /**
     * Создание нового уведомления о непрочитанном комментарии
     *
     * @param int $model_id id модели связанной с уведомлением
     */
    protected function insert($model_id)
    {
        parent::insert(array(
            'entity' => $this->entity,
            'entity_id' => (int)$this->entity_id,
            'unread_model_ids' => array((int)$model_id)
        ));
    }

    /**
     * Помечаем что уведомление о новых комментариях к статье прочитано
     *
     * @param $recipient_id int id пользователя, который должен получить уведомление
     * @param $entity string класс модели, к которой написан комментарий
     * @param $entity_id int id модели, к которой написан комментарий
     */
//    protected function read($recipient_id, $entity, $entity_id)
//    {
//        $exist = $this->getCollection()->findOne(array(
//            'type' => $this->type,
//            'recipient_id' => (int)$recipient_id,
//            'read' => 0,
//            'entity' => $entity,
//            'entity_id' => (int)$entity_id,
//        ));
//        if (!empty($exist)) {
//            $this->getCollection()->findAndModify(
//                array("_id" => $exist['_id']),
//                array('$set' => array('read' => 1, "read_time" => time())),
//                null
//            );
//        }
//    }

    /**
     * Возвращает модель контента с которой связано уведомление
     * @return mixed
     */
    public function getEntity()
    {
        $class = $this->entity;
        return $class::model()->findByPk($this->entity_id);
    }

    /**
     * Помечаем комментарий как прочитанный
     * @param $model_id int
     */
    public function setCommentRead($model_id)
    {
        foreach ($this->unread_model_ids as $key => $unread_model_id)
            if ($unread_model_id == $model_id) {
                unset($this->unread_model_ids[$key]);
                $this->read_model_ids [] = (int)$model_id;
            }
    }

    /**
     * Сохраняем модель
     */
    public function save()
    {
        $this->count = count($this->unread_model_ids);

        if (empty($this->unread_model_ids))
            $this->read = 1;

        $this->getCollection()->update(
            array('_id' => $this->_id),
            array(
                'unread_model_ids' => $this->unread_model_ids,
                'read_model_ids' => $this->read_model_ids,
                'count' => (int)$this->count,
                'read' => (int)$this->read,
            )
        );
    }
}