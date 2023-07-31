<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sp';

    protected $fillable = [
        'id_sp',
        'nama_sp',
    ];
}
