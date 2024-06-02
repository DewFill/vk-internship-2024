<?php

namespace App\models;

class Product implements Structure
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

    function getName(): string
    {
        return $this->name;
    }

    function getImageURL(): string
    {
        return $this->image_url;
    }
}