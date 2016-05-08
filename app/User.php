<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Presenters\UserPresenter;

class User extends Authenticatable
{

    use UserPresenter;
    
    /**
     * The table assigned to this model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * Find a user by email if it exists or create a new one if it doesn't.
     *
     * @param Facebook type $user
     * @return App\User
     */
    public static function findOrCreate($user)
    {
        if ($authUser = static::where('facebook_id', $user->getId())->first()) {
            return $authUser;
        }

        return static::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'facebook_id' => $user->getId(),
            ]);
    }

}
