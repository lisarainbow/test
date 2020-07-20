<?php

namespace App\Http\Models\Post;

use App\Http\Models\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $message
 *
 * @property User $sender
 * @property User $receiver
 *
 * @package App\Http\Models\Post
 */
class Post extends Model
{
    protected $fillable = [
        'message'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * @param $senderId
     * @param $receiverId
     * @return mixed
     */
    public static function getChatMessages($senderId, $receiverId)
    {
        return static::where(['receiver_id' => $receiverId, 'sender_id' => $senderId])
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where(['receiver_id' => $senderId, 'sender_id' => $receiverId]);
            })->get()->sortBy('created_at');
    }
}
