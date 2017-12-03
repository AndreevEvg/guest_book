<?php
define('ROOT', dirname(__FILE__));
require(ROOT . '/lib/autoload.php');
require(ROOT . '/config/dbConnect.php');

$gBookAddMessage = new gBookAddMessage($DB_con);
$gbookShowMessage = new gBookShowMessage($DB_con);
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
            <?php
            if (isset($_GET['id'])) {             
                $parent_id = $_GET['id'];
                $gBookAddMessage->addAnswerMessage($parent_id);            
            } else {              
                $gBookAddMessage->addMessage();
            }
            ?>          
            <div class="comments">
                <?php $gbookShowMessage->showMessage(); ?>
            </div>
        </div>
    </body>
</html>
