<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermissionDetail extends Model
{
    protected $table = 'user_permission_detail';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_id',
        'permission_detail_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function permissionDetail()
    {
        return $this->belongsTo(PermissionDetail::class, 'permission_detail_id');
    }
}
