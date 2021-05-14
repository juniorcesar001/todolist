<?php


namespace Source;

use \PDO;
use \PDOException;

class Connect
{
    // TODOS MEMBROS DE UMA CLASSE (SEM OBJETO)
    private const HOST = "localhost";
    private const USER = "root";
    private const DBNAME = "todolist";
    private const PASSWD = "";


    private const OPTIONS = [
        // Garantir que o charset do pdo seja o mesmo do banco de dados
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        // Sempre que ocorrer um erro, tem uma excessão
        PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
        // Converter qualquer resultado em um fetch, ou seja, resultado prontos!!
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        // Dependendo do banco usado, alguns bancos usam nomes de tabelas em MAIUSCULO ou minisculo,
        // Nesse caso é Natural, sem destinção
        PDO::ATTR_CASE=> PDO::CASE_NATURAL,
    ];

    private static $instance;

    public static function getInstance(): PDO
    {
        if(empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME,
                    self::USER,
                    self::PASSWD,
                    self::OPTIONS
                );
            } catch (PDOException $exception) {
                //Trava tudo o código
                die("<h1>Whoops! Erro ao conectar</h1>");
            }
        }
        return self::$instance;
    }
//    final function __construct()
//    {
//    }

//    final private function __clone() //Mesmo que eu herde a classe... não consigo rodar a rotina
//    {
//        // TODO: Implement __clone() method.
//    }
}
