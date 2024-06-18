<?php

namespace App\Models;


use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extrakurikuler extends Model
{
    use HasFactory;
    protected $table = 'extrakurikulers';
    protected $fillable = ['nama', 'deskripsi', 'gambar', 'hari', 'time'];

    public function siswas()
{
    return $this->belongsToMany(Siswa::class, 'members', 'id_extrakurikuler', 'id_siswa');
}



}