<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kuota_rw extends Model
{
    public $table = "kuota_rw";
    use HasFactory;

    protected $fillable = [
        'total',
        'th_penerimaan_id',
        'dusun_id',
        'rw_id',
    ];
}
