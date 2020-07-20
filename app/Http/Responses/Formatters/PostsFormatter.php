<?php

namespace App\Http\Responses\Formatters;

use App\Http\Models\Post\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostsFormatter
 * @package App\Http\Responses\Formatters
 */
class PostsFormatter
{
    /**
     * @var Post $post
     */
    private $post = null;

    /**
     * @var Post[] $posts
     */
    private $posts = [];

    /**
     * PostsFormatter constructor.
     * @param array $posts
     * @param null $post
     */
    public function __construct($posts = [], $post = null)
    {
        $this->post = $post;
        $this->posts = $posts;
    }

    /**
     * @return array
     */
    public function formatChatPosts()
    {
        $data = [];

        foreach ($this->posts as $post) {
            $class = (Auth::user()->id === $post->sender->id) ? 'chat-item chat-item-right' : 'chat-item chat-item-left';

            $data[] = [
                'class' => $class,
                'name_sender' => $post->sender->name,
                'date_time' => $post->created_at ? $post->created_at->isoFormat('DD/MM/YYYY hh:mm A') : null,
                'message' => $post->message,
            ];
        }

        return $data;
    }
}
