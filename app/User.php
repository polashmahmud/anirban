<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'join', 'email_verified_at', 'password', 'role', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('avatar')
            ->registerMediaConversions(function (Media $media = null) {

                $this->addMediaConversion('small')
                    ->width(50)
                    ->height(50);

                $this->addMediaConversion('thumb')
                    ->width(150)
                    ->height(150);

                $this->addMediaConversion('medium')
                    ->width(300)
                    ->height(300);
            });
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}
