<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 't_mahasiswa';

    protected $fillable = [
        'id',
        'id_user',
        'kelas_id',
        'nama',
        'nim',
        'tempat_lahir',
        'tanggal_lahir',
        'edit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
