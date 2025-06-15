<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiriCiri extends Model
{
    use HasFactory;

    protected $table = 'ciri_ciri';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'deskripsi'
    ];

    public function rules()
    {
        return $this->hasMany(Rule::class, 'kode_ciri', 'kode');
    }
}
