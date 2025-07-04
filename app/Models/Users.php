<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'address',
        'gender',
        'status'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->user_id) {
                $model->user_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function userAccount()
    {
        return $this->hasOne(UserAccount::class, 'user_id', 'user_id');
    }
    public function userPermissionDetail()
    {
        return $this->hasManyThrough(
            PermissionDetail::class,
            UserPermissionDetail::class,
            'user_id',
            'permission_detail_id',
            'user_id',
            'id'
        )->with('module');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }
}
