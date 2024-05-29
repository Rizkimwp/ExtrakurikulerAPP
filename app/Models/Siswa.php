<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Extrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $fillable = ['nama', 'nomor_hp', 'nama_wali', 'id_kelas', 'alamat'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ekstrakurikulers()
{
    return $this->belongsToMany(Extrakurikuler::class, 'members', 'id_siswa', 'id_ekstrakurikuler');
}

}