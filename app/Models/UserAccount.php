<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = 'user_account';

    protected $primaryKey = 'user_account_id';
    public $incrementing = true;
    protected $keyType = 'bigInteger';
    protected $fillable = [
        'user_account_id',
        'user_id',
        'username',
        'password',
    ];

    public function user()
    {
        return $this->hasOne(Users::class, 'user_id', 'user_id');
    }
}
