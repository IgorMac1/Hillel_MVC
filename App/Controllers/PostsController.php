<?php

namespace App\Controllers;

use App\Controllers\Admin\BaseController;
use App\Helpers\SessionHelper;
use App\Models\Post;
use Core\View;

class PostsController extends BaseController
{

    public function index()
    {
        $currentUser = SessionHelper::getUser();
        $userId = $currentUser ? $currentUser['id'] : null;
        $posts = Post::select()
            ->where('author_id', '=', $userId)
            ->get();
        View::render('user/posts/parts/product_list', compact('posts'));
    }
}