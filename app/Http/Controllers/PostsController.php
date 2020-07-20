<?php

namespace App\Http\Controllers;

use App\Http\Models\Post\Post;
use App\Http\Requests\SavePostRequest;
use App\Http\Responses\Formatters\PostsFormatter;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * init
     */
    public function init()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersMessages(Request $request)
    {
        $senderId = $request->user()->id;
        $receiverId = (int) $request->get('receiver_id');

        return response()->json(['data' => view('users_messages', ['posts' => (new PostsFormatter(Post::getChatMessages($senderId, $receiverId)))->formatChatPosts()])->toHtml()]);
    }

    /**
     * @param SavePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNewUsersMessage(SavePostRequest $request)
    {
        $senderId = $request->user()->id;
        $receiverId = $request->post('receiver_id');

        $post = new Post();
        $post->sender_id = $senderId;
        $post->receiver_id = $receiverId;
        $post->message = $request->post('message');
        $post->save();

        return response()->json(['data' => view('users_messages', ['posts' => (new PostsFormatter(Post::getChatMessages($senderId, $receiverId)))->formatChatPosts()])->toHtml()]);
    }

}
