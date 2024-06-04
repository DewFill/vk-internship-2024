<?php

interface OrderRepositoryInterface
{
    public function createOrder(int $customerId, array $products, int $city_id);

    public function getOrderById(int $orderId);
}