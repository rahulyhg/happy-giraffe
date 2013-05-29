<?php
/**
 * Простая модель для монго-документа, реализует основные операции
 *
 * @author Alex Kireev <alexk984@gmail.com>
 */

class HMongoModel
{
    protected $_collection_name;
    protected $_db = 'mongo';
    protected $_collection;
    protected $_id;

    /**
     * @return MongoCollection
     */
    protected function getCollection()
    {
        if (empty($this->_collection))
            $this->_collection = Yii::app()->edmsMongoCollection($this->_collection_name, $this->_db);

        return $this->_collection;
    }

    /**
     * Возвращает модель по id
     * @param $id int
     * @return array|null
     */
    public function findByPk($id)
    {
        return $this->getCollection()->findOne(array('_id' => new MongoId($id)));
    }

    /**
     * Удалить модель по id
     * @param $id
     */
    public function deleteByPk($id)
    {
        $this->getCollection()->remove(array('_id' => $id));
    }

    /**
     * Удалить модель
     */
    public function delete()
    {
        self::getCollection()->remove(array('_id' => $this->_id));
    }
}