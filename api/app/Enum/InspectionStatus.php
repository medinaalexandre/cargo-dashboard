<?php

namespace App\Enum;

enum InspectionStatus: string
{
    case INSPECTION_STATUS_APPROVED = 'A';
    case INSPECTION_STATUS_PENDING = 'P';
    case INSPECTION_STATUS_REJECTED = 'R';

    public function toString(): string
    {
        return match ($this) {
            self::INSPECTION_STATUS_APPROVED => 'Approved',
            self::INSPECTION_STATUS_PENDING => 'Pending',
            self::INSPECTION_STATUS_REJECTED => 'Rejected',
        };
    }
}
