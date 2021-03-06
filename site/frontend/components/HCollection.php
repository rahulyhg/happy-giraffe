<?php

namespace site\frontend\components;

/**
 * Коллекция
 *
 * @author Emil Vililyaev
 * @author Sergey Gubarev
 */
class HCollection
{

    /**
     * @var array
     */
    private $_arrObjects;

    /**
     * @param QaQuestion[] $arrQuestions
     */
    public function __construct($arrObjects)
    {
        $this->_arrObjects = $arrObjects;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return count($this->_arrObjects);
    }

    /**
     * @return NULL|mixed
     */
    public function getFirstObjects()
    {
        return is_array($this->_arrObjects) ? $this->_arrObjects[0] : NULL;
    }

    /**
     *@return array
     */
    public function getObjects()
    {
        return $this->_arrObjects;
    }

    /**
     * @param string $fieldName
     * @param integer $value
     * @return NULL|self
     */
    public function sortedByField($fieldName, $value)
    {
        if (empty($this->_arrObjects))
        {
            return new self([]);
        }

        $result = [];

        foreach ($this->_arrObjects as $object)
        {
            if (isset($object->{$fieldName}) && $object->{$fieldName} == $value)
            {
                $result[] = $object;
            }
        }

        return new self($result);
    }

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->getCount() == 0;
    }

    /**
     * @param array $arrFields $key => $value format
     * @return NULL|self
     */
    public function sortedByFields($arrFields = [])
    {
        if (empty($this->_arrObjects))
        {
            return new self([]);
        }

        $object = $this;

        foreach ($arrFields as $name => $value)
        {
            $object = $object->sortedByField($name, $value);
        }

        return $object;
    }

    /**
     * Получить данные по всеми объектам
     *
     * @return array|null
     */
    public function toArray()
    {
        if (empty($this->_arrObjects))
        {
            return ;
        }

        $arr = array_map(
                    function($model)
                    {
                        if ($model instanceof \IHToJSON) {
                            return $model->toJSON();
                        }
                    },
                    $this->_arrObjects
                );

        return $arr;
    }
}