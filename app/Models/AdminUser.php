<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use LaravelRocket\Foundation\Models\AuthenticatableBase;


class AdminUser extends AuthenticatableBase
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates  = [];

    protected $presenter = \App\Presenters\AdminUserPresenter::class;

    // Relations
    public function profileImage()
    {
        return $this->belongsTo('App\Models\File', 'profile_image_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany('App\Models\AdminUserRole', 'admin_user_id', 'id');
    }

    // Utility Functions

}
