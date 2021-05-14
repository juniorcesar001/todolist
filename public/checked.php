<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Connect;

if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['id'])  {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRIPPED);

    try {
        $query = Connect::getInstance()->query("SELECT * FROM tarefas WHERE id_tarefa = '{$id}'");
        $task = $query->fetch();
    } catch (PDOException $exception) {
        var_dump($exception);
    }

    if($task->checked == 0) {
        $check = 1;
    } else {
        $check = 0;
    }

    $update = "
            UPDATE tarefas SET checked='{$check}'
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