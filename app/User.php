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
    protected $fillable = ['name', 'facebook_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

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
                'facebook_id' => $user->getId(),
            ]);
    }

    /**
     * The User can have many Articles.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * The User can have many Questions.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
