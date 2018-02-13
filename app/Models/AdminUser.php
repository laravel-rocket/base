<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use LaravelRocket\Foundation\Models\AuthenticatableBase;

/**
 * App\Models\AdminUser.
 *
 * @method \App\Presenters\AdminUserPresenter present()
 */
class AdminUser extends AuthenticatableBase
{
    use HasApiTokens, Notifiable;

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
    protected $hidden = [];

    protected $dates  = [
    ];

    protected $presenter = \App\Presenters\AdminUserPresenter::class;

    // Relations
    public function profileImage()
    {
        return $this->belongsTo(\App\Models\File::class, 'profile_image_id', 'id');
    }

    public function adminUserRoles()
    {
        return $this->hasMany(\App\Models\AdminUserRole::class, 'admin_user_id', 'id');
    }

    // Utility Functions
}
