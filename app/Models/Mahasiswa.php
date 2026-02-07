<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasUuids;
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'nim',
        'nama',
        'sex',
        'prodi',
        'tanggal_masuk'
    ];
}
