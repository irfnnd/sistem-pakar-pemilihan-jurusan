<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecerdasan extends Model
{
    use HasFactory;

    protected $table = 'kecerdasan';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama_kecerdasan',
        'deskripsi'
    ];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'kode_kecerdasan', 'kode');
    }

    public function rules()
    {
        return $this->hasMany(Rule::class, 'kode_kecerdasan', 'kode');
    }
}
