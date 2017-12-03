<?php

class gBookAddMessage extends gBook
{
    /* Метод добавляет комментарии в БД */
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
    
    /* Метод добавляет ответы к комментариям */
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
}