<?php

namespace App;

enum PersonStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case BLOCKED = 'blocked';
    case UNBLOCKED = 'unlocked';
    case DELETED = 'deleted';
    public function label()
    {
        return match ($this) {
            self::ACTIVE => 'Hoạt động',
            self::INACTIVE => 'Không hoạt động',
            self::SUSPENDED => 'Tạm ngưng',
            self::BLOCKED => 'Đã chặn',
            self::UNBLOCKED => 'Đã mở khóa',
            self::DELETED => 'Đã xóa'
        };
    }
}
