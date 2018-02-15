<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function all($username, Request $request) {
        $user = User::where('username', $username)->get()->first();
        if(!$user) abort(404);

        $posts = $user->posts();
        if($user->id !== Auth::id()) $posts->where('is_private', '0');
        if($request->start !== null && $request->amount !== null) $posts->skip((int)$request->start)->take((int)$request->amount);
        return response()->json([
            'success' => false,
            'post' => $posts->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function add(Request $request) {
        $validation = Validator::make($request->all(), [
            'content' => Post::$rules['content'],
            'isPrivate' => Post::$rules['is_private'],
        ]);
        if ($validation->fails() ) return response()->json([ 'success' => false ]);
        $post = new Post();
        $post->content = $request->content;
        $post->is_private = $request->isPrivate;
        Auth::user()->posts()->save($post);
        return response()->json([
            'success' => true,
            'post' => $post,
        ]);
    }

    public function update(Post $post, Request $request) {
        $validation = Validator::make($request->all(), [
            'content' => Post::$rules['content'],
            'isPrivate' => Post::$rules['is_private'],
        ]);
        if ($validation->fails() ) return response()->json([ 'success' => false ]);
        $post->content = $request->content;
        $post->is_private = $request->isPrivate;
        $post->save();
        return response()->json([
            'success' => true,
            'post' => $post,
        ]);
    }

    public function delete(Post $post) {
        $post->delete();
        return response()->json([ 'success' => true ]);
    }

    public function toggleLike(Post $post) {
        if($post->isLikedBy(User::find(Auth::user()->id))) {
            Auth::user()->postsLiked()->detach($post->id);
        } else {
            Auth::user()->postsLiked()->attach($post->id);
        }
        return response()->json([
            'success' => true,
            'liked' => $post->isLikedBy(User::find(Auth::user()->id)),
        ]);
    }
}
