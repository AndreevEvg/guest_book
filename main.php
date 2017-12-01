<?php
define('ROOT', dirname(__FILE__));
require(ROOT . '/lib/autoload.php');
require(ROOT . '/lib/dbConnect.php');

$gBook = new gBook($DB_con);
$gBook->addMessage();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Гостевая книга</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <body>
        <div class="container">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="exampleInputName">Имя:</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputMessage">Сообщение</label>
                    <textarea class="form-control" rows="3" name="text"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Отправить</button>
            </form>
            
            <div class="comments">
                <ul>
                <?php foreach ($gBook->showMessage() as $res): ?>
                    <li>
                        <div class='name'><?= $res['name'];?></div>
                        <div class='text'><?= nl2br($res['text']);?></div>
                        <div class="answer"><a href="?id=<?= $res['id'];?>">Ответить</a></div>
                        <ul>
                            <?php foreach ($gBook->createTree($res['id']) as $node): ?>
                            <li>
                                <div class='nameTree'><?= $node['name'];?></div>
                                <div class='text'><?= $node['text']; ?></div>
                                <div class="answer"><a href="?id=<?= $node['id'];?>">Ответить</a></div>
                                
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <hr>
                <?php endforeach ?>
                </ul>
            </div>
        </div>


        
    </body>
</html>
