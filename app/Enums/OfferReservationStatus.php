<?php

namespace App\Enums;

enum OfferReservationStatus: string
{
    case AVAILABLE = 'Available';
    case LOCKED = 'Locked';
    case RESERVED = 'Reserved';
}
