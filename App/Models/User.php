<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public static string|null $tableName = 'users';

    public static array $fillable = [
        'email',
        'password',
        'is_admin',
        'name',
        'surname'
    ];

}