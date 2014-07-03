<?php
/**
 * Интерфейс для моделей, которые могут иметь фото-коллекцию
 *
 * Описывает методы, которые необходимы поддерживаться основной моделью для корректной работы коллекции
 */

namespace site\frontend\modules\photo\components;


interface IPhotoCollection
{
    /**
     * Подпись коллекции
     * @return string
     */
    public function getCollectionLabel();

    /**
     * Заголовок коллекции
     * @return string
     */
    public function getCollectionTitle();

    /**
     * Описание коллекции
     * @return string
     */
    public function getCollectionDescription();
} 