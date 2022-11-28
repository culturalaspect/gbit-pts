<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFinancial extends Model
{
    use HasFactory;

    protected $fillable = array(
        'company_id',
        'phase_id',
        'total_sanctioned_amount',
        'total_installments',
        'installment_markup_percentage',
        'installment_amount',
        'installment_total_months',
        'is_sanctioned_by_kcbl',
        'is_completed_by_kcbl'
    );

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function phase() {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
