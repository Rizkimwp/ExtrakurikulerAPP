<?php

namespace App\Models;

use App\Models\User;
use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;

    // Define the table name (optional if following Laravel naming conventions)
    protected $table = 'posts';

    // Define the fillable fields
    protected $fillable = ['judul', 'body', 'image', 'excerpt', 'user_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}