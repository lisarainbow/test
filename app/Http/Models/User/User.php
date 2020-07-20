<?php

namespace App\Http\Models\User;

use App\Http\Models\Post\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property string $dob
 * @property string $location
 * @property integer $phone
 * @property integer $eaten
 *
 * @property Post[] $receivedPosts
 * @property Post[] $sentPosts
 *
 * @package App\Http\Models\User
 */
class User extends Authenticatable
{
    use Notifiable;

    const EATEN_YES = 1;
    const EATEN_NO = 0;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'dob', 'location', 'phone', 'eaten','last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param null $name
     * @param null $lastName
     * @param null $location
     * @param string $sort
     * @return mixed
     */
    public static function getSortedUsers($name = null, $lastName = null, $location = null, $sort = 'asc')
    {
        return static::when(!empty($name), function ($sub) use ($name) {
            return $sub->where('name', 'like', "%{$name}%");
        })->when(!empty($lastName), function ($sub) use ($lastName) {
            return $sub->where('last_name', 'like', "%{$lastName}%");
        })->when(!empty($location), function ($sub) use ($location) {
            return $sub->where('location', 'like', "%{$location}%");
        })->orderBy('last_login_at', $sort)->get();
    }

     /**
     * @param $eaten
     */
    public static function markingEatenUsers($eaten)
    {
        static::whereIn('id', $eaten)
            ->where('eaten', '=', self::EATEN_NO)
            ->update(['eaten' => self::EATEN_YES]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedPosts()
    {
        return $this->hasMany(Post::class, 'receiver_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentPosts()
    {
        return $this->hasMany(Post::class, 'sender_id', 'id');
    }
}
