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
    
    /* Метод отрисовывает шаблон вывода комментариев */
    protected function templateMessage($result)
    {
        echo "<ul>";
        foreach ($result as $res) {
            echo "<li>";
            echo "<div class='nameTree'>" . $res['name'] . "</div>";
            echo "<div class='text'>" . nl2br($res['text']) . "</div>";
            echo "<div class='answer'><a class='ans' href='?id=" . $res['id'] . "'>Ответить</a></div>";
            $this->createTree($res['id']);
            echo "</li>";
        }
        echo "</ul>";
    }
}
