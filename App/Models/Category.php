<?php

namespace App\Models;

use Core\Model;

class Category extends Model
{
    static public string|null $tableName = "categories";

    public static array $fillable = [
        'title',
        'description',
        'image'
    ];
}