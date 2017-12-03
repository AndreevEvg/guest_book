<?php

class gBook
{
    protected $db;
    
    public function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
 
    /* Метод фильтрации данных получаемых от пользователя */
    protected function clearData($data, $type = "s")
    {
        switch ($type) {
            case "s":
                $data = trim(strip_tags($data));
                break;
        }
        
        return $data;
    }
    
    /* Метод отрисовывает форму для комментариев */
    protected function createFormComments()
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
    
    /* Метод отправляет уведомление на почту о новых комментариях */
    protected function sendEmail()
    {
        return mail('example@example.ru', 'Комментарий', "Вам пришел новый комментарий!!!");
    }
}