<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;

use App\Validators\Categories\CreatePostsValidator;
use Core\View;

class PostsController extends BaseController
{
    public function index()
    {
        $posts = Post::all();
        View::render('admin/posts/index', compact('posts'));

    }

    public function create()
    {
        View::render('admin/posts/create');
    }

    public function edit(int $id)
    {
        $posts = Post::find($id);
        View::render('admin/posts/edit', compact('posts'));
    }

    public function store()
    {

        $fields = filter_input_array(INPUT_POST, $_POST, true);

        $validator = new CreatePostsValidator();

        if (!$validator->validate($fields)) {
            dd($fields, $validator->getErrors());
        }
        if (Post::create($fields)) {
            redirect('admin/posts');
        } else {
            $_SESSION['posts']['create']['error'] = 'Oops something went wrong';
            redirectBack();
        }
    }
}