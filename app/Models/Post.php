<?php namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $primarykey = "id";
    protected $allowedFields = ['title', 'thumbnail', 'body', 'created_at', 'updated_at'];
}