<?php
require __DIR__ . "/../vendor/autoload.php";

use Source\Connect;

try {
    $query = Connect::getInstance()->query("SELECT * FROM tarefas");
    $tasks = $query->fetchAll();
} catch (PDOException $exception) {
    var_dump($exception);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercicio 3 - To do list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container my-4">

    <h1 class="display-4">TO-DO-LIST</h1>

    <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Criar Tarefa
        </a>
    </p>

    <div class="collapse" id="collapseExample">
        <div class="card card-body mb-3">
            <form action="inserir.php" method="post">
                <div class="row mb-3">
                    <label for="input-tarefa" class="col-sm-2 col-form-label">Tarefa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="task" id="input-tarefa">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="datetime-input" class="col-sm-2 col-form-label">Data de Entrega</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="datetime-local" name="dateTime" value="2021-05-04T13:45:00"  id="datetime-input">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1"">
                                Sem Prazo
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Finalizar</button>
            </form>
        </div>
    </div>

    <!-- ----- TAREFAS ----- -->

    <?php foreach ($tasks as $task){ ?>

    <div class="row border border-2 p-2">
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" <?= $task->checked == 1 ?: 'checked' ?> disabled>
                    <?= $task->tarefa; ?>
                <div class="badge bg-success">
                    <?= $task->data_entrega == "0000-00-00 00:00:00" ? "Sem Prazo" : date('d/m/Y H:i:s', strtotime($task->data_entrega)); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ação
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="delete.php?id=<?= $task->id_tarefa ?>">Deletar Tarefa</a></li>
                    <li><a class="dropdown-item" href="edit.php?id=<?= $task->id_tarefa ?>">Editar Tarefa</a></li>
                    <li><a class="dropdown-item" href="checked.php?id=<?= $task->id_tarefa ?>">Marcar/Desmarcar Tarefa</a></li>
                </ul>
            </div>
        </div>
    </div>

     <?php } ?>

</div>

<!--SCRIPTS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="assets/jquery-3.1.1.min.js"></script>
<script src="assets/main.js"></script>
</body>
</html>