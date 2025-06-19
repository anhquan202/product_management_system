<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    protected $table = 'permission_modules';
    protected $primaryKey = 'permission_module_id';
    protected $fillable = [
        'module_key',
        'module_name',
    ];
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = 'int';

    public function permissionDetails()
    {
        return $this->hasMany(PermissionDetail::class, 'permission_module_id', 'permission_module_id');
    }
}
