<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'permission_id',
        'permission_name',
    ];
}
