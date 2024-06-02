<?php

namespace App\models;

interface Structure
{
    function getName(): string;
    function getImageURL(): string;
}