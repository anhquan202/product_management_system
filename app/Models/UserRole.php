<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    protected $primaryKey = 'user_role_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_role_id',
        'user_id',
        'role_id',
    ];
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Users::class, 'role_id', 'role_id');
    }
}
