<?php

class gBook extends gBookAbstract
{
    private $db;
    
    public function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    
    protected function clearData($data, $type = "s")
    {
        switch ($type) {
            case "s":
                $data = trim(strip_tags($data));
                break;
        }
        
        return $data;
    }
    
    public function addMessage()
    {
        if (!empty($_POST['name']) && !empty($_POST['text'])) {
            $name = $this->clearData($_POST['name']);
            $text = $this->clearData($_POST['text']);
            
            try
            {
                $stmt = $this->db->prepare("INSERT INTO book (name, text) "
                        . "VALUES (:name, :text)");
                $stmt->bindparam(":name", $name);
                $stmt->bindparam(":text", $text);
                $stmt->execute();
                
                header("Location: main.php");
                
                return true;
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    public function showMessage()
    {
        $sql = $this->db->prepare("SELECT * FROM book WHERE parent_id IS NULL");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<ul>";
        foreach ($result as $res) {
            echo "<li>";
            echo "<div class='name'>" . $res['name'] . "</div>";
            echo "<div class='text'>" . nl2br($res['text']) . "</div>";
            echo "<div class='answer'><a class='ans' href='?id=" . $res['id'] . "'>Ответить</a></div>";
            $this->createTree($res['id']);
            echo "<hr>";
            echo "</li>";
        }
        echo "</ul>";
             
    }
    
    protected function createTree($parent_id)
    {
        $sql = $this->db->prepare("SELECT * FROM book WHERE parent_id = $parent_id");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<ul>";
        foreach ($result as $node) {
            echo "<li>";
            echo "<div class='nameTree'>" . $node['name'] . "</div>";
            echo "<div class='text'>" . nl2br($node['text']) . "</div>";
            echo "<div class='answer'><a class='ans' href='?id=" . $node['id'] . "'>Ответить</a></div>";
            $this->createTree($node['id']);
            echo "</li>";
        }
        echo "</ul>";
    }
}

