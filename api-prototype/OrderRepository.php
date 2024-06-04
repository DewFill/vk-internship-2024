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
        try {
            // Создание заказа
            // Запись в кеш
        } catch (Exception) {
            // Выкидывание ошибки
        }
    }

    public function getOrderById(int $orderId)
    {
        $cache = (new RedisCache())->get("order:$orderId");
        if ($cache === false) {
            // Получение заказа по ID из БД
        } else {
            // Получение заказа по ID из кеша
        }
    }
}