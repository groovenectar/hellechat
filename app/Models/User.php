<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    public function service_accounts()
    {
        return $this->hasMany(ServiceAccount::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function voicemails()
    {
        return $this->hasMany(Voicemail::class);
    }

    public function getHashId()
    {
        $hashids = new Hashids(config('app.key'), 6);
        $hid = $hashids->encode($this->id);
        return $hid;
    }

    public static function findByHashId($hashId)
    {
        $hashids = new Hashids(config('app.key'), 6);
        $decoded = $hashids->decode($hashId);

        if(empty($decoded)){
            throw new ModelNotFoundException();
        }

        return static::find($decoded[0]);
    }
}
