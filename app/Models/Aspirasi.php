<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_aspirasi_id',
        'status',
        'siswa_id',
        'kategori_id',
        'feedback',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke InputAspirasi
    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'input_aspirasi_id');
    }

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Accessor untuk badge status
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'menunggu' => 'badge-warning',
            'proses' => 'badge-info',
            'selesai' => 'badge-success',
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }

    // Accessor untuk label status
    public function getStatusLabelAttribute()
    {
        $labels = [
            'menunggu' => 'Menunggu',
            'proses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
        ];

        return $labels[$this->status] ?? '-';
    }

    // Scope untuk filter berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
