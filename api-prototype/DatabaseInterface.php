<?php

interface DatabaseInterface
{
    public function query(string $sql, array $params = []);

    public function beginTransaction();

    public function commit();

    public function rollBack();
}