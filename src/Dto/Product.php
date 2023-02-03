<?php

namespace App\Dto;

class Product
{
    public string $name;
    public string $category;
    /**
     * @var array<Offer>
     */
    public array $offers = [];
}
