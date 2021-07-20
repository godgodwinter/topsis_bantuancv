<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kuota_dusun extends Model
{
    public $table = "kuota_dusun";
    use HasFactory;

    protected $fillable = [
        'total',
        'th_penerimaan_id',
        'dusun_id',
        'rw_id',
    ];
}
