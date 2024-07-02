<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;

    public $timestamps =  false;

    protected $fillable = [
        'tot_weekly',
        'period',
    ];
}
