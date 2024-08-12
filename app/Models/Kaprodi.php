<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $table = 't_kaprodi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'kode_dosen',
        'nip',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
