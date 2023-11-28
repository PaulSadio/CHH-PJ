<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
    use HasFactory;
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'participantname',
        'participantid',
        'participantemail'
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposals::class, 'event_id', 'id');
    }
}
