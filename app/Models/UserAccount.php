<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user_account';

    protected $primaryKey = 'user_account_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_account_id',
        'user_id',
        'username',
        'password',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function user()
    {
        return $this->hasOne(Users::class, 'user_id', 'user_id');
    }
}
