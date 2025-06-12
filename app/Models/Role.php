<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'role_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'role_id',
        'role_name',
        'role_level',
    ];
}
