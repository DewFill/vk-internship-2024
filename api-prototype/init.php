<?php

$db = new MySQLDatabase('127.0.0.1', 'database', 'root', 'password');

// Создание репозиториев
$customerRepository = new CustomerRepository($db);
$productRepository = new ProductRepository($db);
$orderRepository = new OrderRepository($db);

// Инициализация клиента S3 и создание репозитория
$s3Client = null;
$s3Repository = new S3Repository($s3Client);

// Создание сервиса для работы с заказами
$orderService = new OrderService($customerRepository, $productRepository, $orderRepository, $s3Repository);

try {
    $customerId = 1; // id пользователя
    $city_id = 1; // id города
    $productData = [
        ['product_id' => 2, 'quantity' => 2],
        ['product_id' => 3, 'quantity' => 1]
    ]; // Пример данных товаров

    $order = $orderService->checkout($customerId, $productData, $city_id);

    echo "Order created successfully: " . json_encode($order);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
