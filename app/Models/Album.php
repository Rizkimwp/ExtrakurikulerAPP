<?php

namespace App\Models;

use App\Models\Galery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function galery()
    {
        return $this->hasMany(Galery::class);
    }
}