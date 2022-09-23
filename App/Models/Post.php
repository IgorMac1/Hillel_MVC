<?php


 namespace App\Models;

 use Core\Model;

 class Post extends Model
 {
     static public string|null $tableName = "posts";

     public static array $fillable = [
         'title',
         'content'
     ];




 }