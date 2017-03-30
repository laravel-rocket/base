<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;


class AdminUserRole extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id',
        'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\AdminUserRolePresenter::class;

    // Relations
    

    // Utility Functions

}
