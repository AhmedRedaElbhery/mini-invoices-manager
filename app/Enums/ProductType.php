<?php

namespace App\Enums;

enum ProductType: int
{
    case TypeIsProduct = 0;
    case TypeIsService= 1;
}