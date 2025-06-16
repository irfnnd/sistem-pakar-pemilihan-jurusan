<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rule';

    protected $fillable = [
        'kode_kecerdasan',
        'kode_ciri'
    ];

    public function kecerdasan()
    {
        return $this->belongsTo(Kecerdasan::class, 'kode_kecerdasan', 'kode');
    }

    public function ciriCiri()
    {
        return $this->belongsTo(CiriCiri::class, 'kode_ciri', 'kode');
    }
}
