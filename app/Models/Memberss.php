<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Memberss extends Model
{
    use HasFactory;
    public function remarks() {
        return $this->belongsTo(Remarks::class, 'id');
    }
    protected $table = 'memberss';
    protected $fillable = [
        'membername',
        'memberaddress',
        'memberemail',
        'contactnumber',
        'memberage',
        'membersex',
        'birthday',
        'profilepic'
    ];
}
