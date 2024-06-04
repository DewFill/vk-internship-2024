<?php

class MySQLDatabase implements DatabaseInterface
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        // Инициализация PDO
    }

    public function query(string $sql, array $params = [])
    {
        // Выполнение запроса
    }

    public function beginTransaction()
    {
        // Начало транзакции
    }

    public function commit()
    {
        // Коммит транзакции
    }

    public function rollBack()
    {
        // Откат транзакции
    }
}