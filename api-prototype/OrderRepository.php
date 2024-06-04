<?php

class OrderRepository implements OrderRepositoryInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function createOrder(int $customerId, array $products, int $city_id)
    {
        // Создание заказа
    }

    public function getOrderById(int $orderId)
    {
        // Получение заказа по ID
    }
}