<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    use HasFactory;
    
    protected $table = 'input_aspirasis';
    
    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'lokasi',
        'tanggal',
        'keterangan',
    ];
    protected $casts = [
    'tanggal' => 'date',
];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class);
    }
}
