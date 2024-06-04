<?php

class ProductRepository implements ProductRepositoryInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getProductById($productId)
    {
        $cache = (new RedisCache())->get("product:$productId");
        if ($cache === false) {
            // Получение данных о продукте через БД
        } else {
            // Получение данных о продукте через кеш
        }
    }

    public function getProductVersion($productId)
    {
        $cache = (new RedisCache())->get("product:$productId");
        if ($cache === false) {
            // Получение версии продукта через БД
        } else {
            // Получение версии продукта через кеш
        }
    }

    public function updateProductQuantity($productId, $quantity)
    {
        // Обновление количества продукта
        $cache = (new RedisCache())->set("product:$productId", $quantity);
    }
}