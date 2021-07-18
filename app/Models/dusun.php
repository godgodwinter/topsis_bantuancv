<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dusun extends Model
{
    public $table = "dusun";
    use HasFactory;

    protected $fillable = [
        'nama'
    ];
}
