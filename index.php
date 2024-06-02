<?php

use App\models\Category;
use App\models\Group;
use App\models\Product;
use App\models\Subcategory;

require_once "vendor/autoload.php";

$group1 = new Group();
$group1->setName("Group 1");
$category1 = new Category();
$category1->setName("Category 1");
$subcategory1 = new Subcategory();
$subcategory1->setName("Subcategory 1");
$product1 = new Product();
$product1->setName("Product 1");


$group1->add($category1);
$category1->add($subcategory1);
$subcategory1->add($product1);

foreach ($group1 as $category) {
    print $category->getName();
}