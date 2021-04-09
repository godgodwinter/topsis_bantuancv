<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class th_penerimaan extends Model
{
    public $table = "th_penerimaan";
    use HasFactory;

    protected $fillable = [
        'tahun',
        'kuota',
        'status'
    ];
}
