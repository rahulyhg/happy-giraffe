<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfinityCache
 *
 * @author Кирилл
 */
class InfinityCache extends CDbCache
{

    /**
     * Запрещаем удаление данных из таблицы
     */
    protected function gc()
    {
        return;
    }

}
