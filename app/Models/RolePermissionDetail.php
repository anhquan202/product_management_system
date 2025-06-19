<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermissionDetail extends Model
{
    protected $table = 'role_permission_detail';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'role_id',
        'permission_detail_id',
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissionDetail()
    {
        return $this->belongsTo(PermissionDetail::class, 'permission_detail_id');
    }
}
