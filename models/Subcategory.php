<?php

namespace App\models;

class Subcategory extends \ArrayIterator implements Structure
{
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    private string $name;
    private string $image_url;

    /**
     * @param Product[] $array Массив товаров
     */
    public function __construct(array $array = [])
    {
        parent::__construct($array);
    }

    public function current(): Product
    {
        return parent::current();
    }

    function add(Product $product): void
    {
        $this->append($product);
    }

    function getName(): string
    {
        return $this->name;
    }

    function getImageURL(): string
    {
        return $this->image_url;
    }
}