<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminmemo extends Model
{
    use HasFactory;
    protected $table = 'adminmemo';
    protected $fillable = [
        'memodate',
        'memofile'
    ];
}
