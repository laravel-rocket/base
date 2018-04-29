<?php
namespace App\Models;

use LaravelRocket\ServiceAuthentication\Models\ServiceAuthenticationBase;

/**
 * App\Models\UserServiceAuthentication.
 *
 * @method \App\Presenters\UserServiceAuthenticationPresenter present()
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $service
 * @property string $service_id
 * @property string $image_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereService($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereServiceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserServiceAuthentication extends ServiceAuthenticationBase
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_service_authentications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'service',
        'service_id',
        'image_url',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [];

    protected $presenter = \App\Presenters\UserPresenter::class;

    // Relations
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    // Utility Functions
}
