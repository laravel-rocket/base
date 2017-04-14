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

    protected $dates = [];

    protected $presenter = \App\Presenters\AdminUserPresenter::class;

    // Relations
    public function profileImage()
    {
        return $this->belongsTo(\App\Models\File::class, 'profile_image_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(\App\Models\AdminUserRole::class, 'admin_user_id', 'id');
    }

    // Utility Functions

    /**
     * @param string $targetRole
     * @param bool   $checkSubRoles
     *
     * @return bool
     */
    public function hasRole($targetRole, $checkSubRoles = true)
    {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $role->role;
        }
        if (in_array($targetRole, $roles)) {
            return true;
        }
        if (!$checkSubRoles) {
            return false;
        }
        $roleConfigs = config('admin_user.roles', []);
        foreach ($roles as $role) {
            $subRoles = array_get($roleConfigs, "$role.sub_roles", []);
            if (in_array($targetRole, $subRoles)) {
                return true;
            }
        }

        return false;
    }
}
