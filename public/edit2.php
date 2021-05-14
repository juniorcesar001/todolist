<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Connect;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task']))  {

    $task = filter_var($_POST['task'], FILTER_SANITIZE_STRIPPED);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRIPPED);


    if (isset($_POST['dateTime'])) {
        $dateTime = filter_var($_POST['dateTime'], FILTER_SANITIZE_STRIPPED);
        $dateTime = str_replace("T", " ", $dateTime);
    } else {
        $dateTime = "null";
    }

    $update = "
            UPDATE tarefas SET tarefa='{$task}', data_entrega='{$dateTime}'
            WHERE id_tarefa='{$id}'
    ;";

    try {
        $exec = Connect::getInstance()->exec($update);
        var_dump($exec); // 0 -> Não Executou / 1 -> Executou
        header("Location: index.php");
    } catch (PDOException $exception) {
        var_dump($exception);
    }

} else{
    header("Location: index.php");
}