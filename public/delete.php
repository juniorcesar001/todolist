<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Connect;

if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['id']) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRIPPED);
}

$delete = "DELETE FROM tarefas WHERE id_tarefa='{$id}';";

try {
    $exec = Connect::getInstance()->exec($delete);
    var_dump($exec); // 0 -> Não Executou / 1 -> Executou
    header("Location: index.php");
} catch (PDOException $exception) {
    var_dump($exception);
}