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
        echo '<form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputName">Имя:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMessage">Сообщение</label>
                        <textarea class="form-control" rows="3" name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>';
        
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
    
        public function addAnswerMessage($parent_id)
    {
        echo "<h1>Ответ на комментарий:</h1>";
        echo '<form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputName">Имя:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMessage">Сообщение</label>
                        <textarea class="form-control" rows="3" name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>';
                
        if (!empty($_POST['name']) && !empty($_POST['text'])) {
            $name = $this->clearData($_POST['name']);
            $text = $this->clearData($_POST['text']);
            
            try
            {
                $stmt = $this->db->prepare("INSERT INTO book (parent_id, name, text) "
                        . "VALUES (:parent_id, :name, :text)");
                $stmt->bindparam(":parent_id", $parent_id);
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
        $this->templateMessage($result);         
    }
    
    protected function createTree($parent_id)
    {
        $sql = $this->db->prepare("SELECT * FROM book WHERE parent_id = $parent_id");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $this->templateMessage($result);
    }
    
    public function templateMessage($result)
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

