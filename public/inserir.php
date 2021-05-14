<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $task = filter_var($_POST['task'], FILTER_SANITIZE_STRIPPED);

    if (isset($_POST['dateTime'])) {
        $dateTime = filter_var($_POST['dateTime'], FILTER_SANITIZE_STRIPPED);
        $dateTime = str_replace("T", " ", $dateTime);
        echo $dateTime;

    } else {
        $dateTime = "null";
    }

    $inset = "
            INSERT INTO tarefas (tarefa, data_entrega)
            VALUE ('" . $task . "', '" . $dateTime . "'); ";
    echo $inset;


    try {
        $exec = Connect::getInstance()->exec($inset);
        var_dump($exec); // 0 -> Não Executou / 1 -> Executou
        header("Location: index.php");
    } catch (PDOException $exception) {
        var_dump($exception);
    }

} else{
    header("Location: public/");
}