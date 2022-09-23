<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    static public string|null $tableName = "users";

    public static array $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];
}