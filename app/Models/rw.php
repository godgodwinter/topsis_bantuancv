<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    public $table = "rw";
    use HasFactory;

    protected $fillable = [
        'nama',
        'dusun_id',
        'dusun_nama',
    ];
}
