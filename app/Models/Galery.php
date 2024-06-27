<?php

namespace App\Models;

use App\Models\Album;
use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galery extends Model
{
    use HasFactory;
    protected $table = 'galery';
    protected $fillable = ['nama', 'gambar', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}