<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Hoa\FileLink;

class Kategori extends Model
{
    //
    use HasFactory;
    protected $table = 'kategoris';
    protected $fillable = [
        'ket_kategori'
    ];
}
