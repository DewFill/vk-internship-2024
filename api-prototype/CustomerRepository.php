<?php

class CustomerRepository implements CustomerRepositoryInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getCustomerById($customerId)
    {
        $cache = (new RedisCache())->get("user:$customerId");
        if ($cache === false) {
            // Получение данных пользователя по ID через БД
        } else {
            // Получение данных пользователя по ID через кеш
        }
    }
}