<?php

interface ProductRepositoryInterface
{
    public function getProductById($productId);

    public function getProductVersion($productId);

    public function updateProductQuantity($productId, $quantity);
}