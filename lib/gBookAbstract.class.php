<?php

abstract class gBookAbstract
{ 
    /* Метод добавляет комментарии в БД */
    abstract function addMessage();
    
    /* Метод добавляет ответы к комментариям */
    abstract function addAnswerMessage($parent_id);
     
    /* Метод показывает комментарии */
    abstract function showMessage();
    
    /* Фильтрация данных получаемых от пользователя */
    abstract protected function clearData($data, $type);
    
    /* Метод отрисовывает шаблон вывода комментариев */
    abstract protected function templateMessage($result);
    
    /* Метод создает дерево комментариев */
    abstract protected function createTree($parent_id);
    
 }

