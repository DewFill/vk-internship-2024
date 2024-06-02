<?php

namespace App\models;

class Category extends \ArrayIterator implements Structure
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
     * @param Subcategory[] $array Массив подкатегорий
     */
    public function __construct(array $array = [])
    {
        parent::__construct($array);
    }

    public function current(): Subcategory
    {
        return parent::current();
    }

    function add(Structure $subcategory): void
    {
        $this->append($subcategory);
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