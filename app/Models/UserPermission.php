<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'user_permissions';

    protected $primaryKey = 'user_permission_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_permission_id',
        'user_id',
        'permission_id',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'permission_id');
    }
}
