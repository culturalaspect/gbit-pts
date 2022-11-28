<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInstallment extends Model
{
    use HasFactory;

    protected $fillable = array(
        'company_id',
        'phase_id',
        'installment_no',
        'amount_paid',
        'date_of_payment'
    );

    // public function owner() {
    //     $this->belongsTo(User::class, 'owner_id');
    // }
}
