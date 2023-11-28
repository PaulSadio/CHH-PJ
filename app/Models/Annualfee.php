<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annualfee extends Model
{
    use HasFactory;
    protected $table = 'annualfee';
    protected $primaryKey = 'id';
    protected $fillable = ['annualfee_status'];

    public function memberss() {
        return $this->belongsTo(Memberss::class);
    }
}
