<?php

namespace App\Models;

use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galery extends Model
{
    use HasFactory;
    protected $table = 'galery';
    protected $fillable = ['nama', 'gambar', 'id_extrakurikuler'];

    public function extrakurikuler()
    {
        return $this->belongsTo(Extrakurikuler::class, 'id_extrakurikuler');
    }
}