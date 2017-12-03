<?php

class gBookShowMessage extends gBook
{
    /* Метод показывает комментарии */
    public function showMessage()
    {
        $sql = $this->db->prepare("SELECT * FROM book WHERE parent_id IS NULL");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $this->templateMessage($result);         
    }
    
    /* Метод создает дерево комментариев */
    protected function createTree($parent_id)
    {
        $sql = $this->db->prepare("SELECT * FROM book WHERE parent_id = $parent_id");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $this->templateMessage($result);
    }
}
