<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_warga extends Model
{
    public $table = "data_warga";
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'jk',
        'dusun_id',
        'dusun_nama',
        'rw_id',
        'rw_nama',
        'hp'
    ];
}
