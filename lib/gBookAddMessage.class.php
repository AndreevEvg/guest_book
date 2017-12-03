<?php

class gBookAddMessage extends gBook
{
    /* Метод добавляет комментарии в БД */
    public function addMessage()
    {
        $this->createFormComments();
        
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
                $this->sendEmail();
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
        $this->createFormComments();
                
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
                $this->sendEmail();
                header("Location: main.php");
                
                return true;
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
}