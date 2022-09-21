<?php

namespace App\Validators;

use App\Validators\Base\UserBaseValidator;

class UserCreateValidator extends UserBaseValidator
{
    protected array $errors = [
        'name_error' => 'The name should contain more than 2 symbols',
        'surname_error' => 'The name should contain more than 2 symbols',
        'email_error' => 'Email is invalid',
        'password_error' => 'Password is invalid',
    ];

    protected array $rules = [
        'name' => '/[A-Za-zА-Яа-я]{2,50}/',
        'surname' => '/[A-Za-zА-Яа-я]{2,50}/',
        'email' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{0,30}[0-9A-Za-z]?)|([0-9А-Яа-я]{1}[-0-9А-я\.]{0,30}[0-9А-Яа-я]?))@([-A-Za-z]{1,}\.){1,}[-A-Za-z]{2,})$/',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/'
    ];
}