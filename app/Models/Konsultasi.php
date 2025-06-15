<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'nama_siswa',
        'asal_sekolah',
        'jawaban',
        'hasil',
        'metode'
    ];

    protected $casts = [
        'jawaban' => 'array',
        'hasil' => 'array'
    ];
}
