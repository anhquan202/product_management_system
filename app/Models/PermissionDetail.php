<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionDetail extends Model
{
    protected $table = 'permission_detail';
    protected $primaryKey = 'permission_detail_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'permission_module_id',
        'permission_key',
        'permission_name',
    ];

    public function module()
    {
        return $this->belongsTo(PermissionModule::class, 'permission_module_id', 'permission_module_id');
    }
}
