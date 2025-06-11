<?php

namespace App;

enum PersonGender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';
    case OTHER = 'Other';

    public function label()
    {
        return match ($this) {
            self::MALE => 'Nam',
            self::FEMALE => 'Nữ',
            self::OTHER => 'Khác'
        };
    }
}
