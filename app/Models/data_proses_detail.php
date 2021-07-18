<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_proses_detail extends Model
{
    public $table = "data_proses_detail";
    use HasFactory;

    protected $fillable = [
        'nik',
        'th_penerimaan_id',
        'setting_range_id',
        'bobot_sr',
        'datareal',
        'kriteria_id'
    ];
}
