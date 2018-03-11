<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use LaravelRocket\Foundation\Models\AuthenticatableBase;

/**
 * App\Models\AdminUser.
 *
 * @method \App\Presenters\AdminUserPresenter present()
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $profile_image_id
 * @property string|null $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminUserRole[] $adminUserRoles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\File $profileImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereProfileImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereUpdatedAt($value)
 * @mixin \Eloquent
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
