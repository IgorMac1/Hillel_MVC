<?php

namespace App\Validators\Categories;

use App\Validators\Base\BaseValidator;

class CreatePostsValidator extends BaseValidator
{

    protected array $errors = [
//        'title_error' => 'Title is not valid',
//        'description_error' => 'Description is not valid'
    ];

    protected array $rules = [
        'title' => '/[\w\s\t\r\n]{5,100}/',
        'description' => '/[\w\s\t\r\n]{10,}/'
    ];


}