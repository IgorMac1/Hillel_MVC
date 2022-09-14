<?php

namespace App\Models;

use Core\Model;

class UserModel extends Model
{
    public static string|null $tableName = 'users';

    public static array $fillable = [
        'age',
        'name'
    ];

}