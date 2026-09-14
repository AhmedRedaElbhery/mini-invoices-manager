<?php

namespace App\Enums;

enum MoneyStatus: int
{
    case Paid= 2;
    case partial_paid= 1;
    case not_paid= 0;
}