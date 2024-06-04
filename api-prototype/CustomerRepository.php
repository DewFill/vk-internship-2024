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
        // Получение данных пользователя по ID
    }
}