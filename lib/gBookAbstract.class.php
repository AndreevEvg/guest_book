<?php

abstract class gBookAbstract
{
    /* Метод добавляет сообщение в БД */
    abstract function addMessage();
    
    /* Фильтрация данных получаемых от пользователя */
    abstract protected function clearData($data, $type);
    
    /* Метод показывает комментарии */
    abstract function showMessage();
    
    /* Метод создает дерево комментариев */
    abstract protected function createTree($parent_id);
 }

