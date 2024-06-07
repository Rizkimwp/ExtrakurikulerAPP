<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $fillable = ['id_siswa', 'id_extrakurikuler'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Extrakurikuler::class, 'id_extrakurikuler');
    }
}