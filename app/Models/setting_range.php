<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting_range extends Model
{
    public $table = "setting_range";
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'tanda',
        'nilai1',
        'nilai2',
        'bobot'
    ];
}
