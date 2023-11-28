<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;
    protected $table = 'proposals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'propname',
        'proptitle',
        'propdate',
        'proplocation',
        'propfile',
        'propstatus'
    ];

    public function registrations()
    {
        return $this->hasMany(Registrations::class, 'event_id', 'id');
    }

   
}
