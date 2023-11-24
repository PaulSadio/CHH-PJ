<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    use HasFactory;
    public function memberss() {
        return $this->belongsTo(Memberss::class, 'id');
    }
    protected $table = 'remarks';
    protected $fillable = [
        'memberremark'
    ];
}
