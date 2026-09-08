<?php

namespace App\Enums;

enum StatusType: int
{
    case Draft = 0;
    case Sent= 1;
    case Paid= 2;
    case Overdue= 3;
    case Cancelled= 4;
}