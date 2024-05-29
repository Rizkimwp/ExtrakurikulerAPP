<?php

namespace App\Models;

use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = ['nama', 'deskripsi', 'jadwal', 'id_extrakurikuler'];

    public function extrakurikuler()
    {
        return $this->belongsTo(Extrakurikuler::class);
    }

}