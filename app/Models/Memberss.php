<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Memberss extends Model
{
    use HasFactory;
    protected $table = 'memberss';
    protected $primaryKey = 'id';
    protected $fillable = [
        'membername',
        'memberaddress',
        'memberemail',
        'contactnumber',
        'memberage',
        'membersex',
        'memberstatus',
        'birthday',
        'profilepic'
    ];

    public function annualFees()
    {
        return $this->hasMany(AnnualFee::class, 'annualfee_id');
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'member_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Create an associated Annualfee record when a Memberss record is created
        static::created(function ($memberss) {
            // You can customize the annualfee data as needed
            $annualfee = new Annualfee([
                'annualfee_status' => 0,
                'annualfee_amount' => 50,
                // ... other fields ...
            ]);

            // Save the relationship
            $memberss->annualFees()->save($annualfee);
        });
    }
}
