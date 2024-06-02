<?php

namespace App\models;

class Group extends \ArrayIterator implements Structure
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
     * @param Category[] $array Массив категорий
     */
    public function __construct(array $array = [])
    {
        parent::__construct($array);
    }

    public function current(): Category
    {
        return parent::current();
    }

    function add(Category $category): void
    {
        $this->append($category);
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