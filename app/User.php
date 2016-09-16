<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{   
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
    protected $fillable = ['name', 'facebook_id', 'score'];

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
     * Find a user by name.
     *
     * @param string $name
     * @return App\User
     */
    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }

    /**
     * Get the Facebook User profile link.
     *
     * @return string
     */
    public function getProfile()
    {
        return 'https://www.facebook.com/' . $this->facebook_id;
    }

    /**
     * Get the Facebook User avatar link.
     *
     * @return string
     */
    public function getAvatar()
    {
        return 'https://graph.facebook.com/v2.7/' . $this->facebook_id . '/picture?type=large';
    }

    /**
     * Check if the user is an Admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    /**
     * Add another $points points to $this User.
     *
     * @return void
     */
    public function addPoints($points)
    {
        DB::table($this->table)->where('id', $this->id)->increment('score', $points);
    }

    /**
     * Remove another $points points to $this User.
     *
     * @return void
     */
    public function removePoints($points)
    {
        DB::table($this->table)->where('id', $this->id)->decrement('score', $points);
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
