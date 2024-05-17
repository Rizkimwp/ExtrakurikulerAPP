<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $fillable = ['id_siswa', 'id_extrakurikuler'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function extrakurikuler()
    {
        return $this->belongsTo(Extrakurikuler::class, 'id_extrakurikuler');
    }
}