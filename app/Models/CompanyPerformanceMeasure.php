<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Phar;

class CompanyPerformanceMeasure extends Model
{
    use HasFactory;

    protected $fillable = array(
        'company_id',
        'phase_id',
        'measure_id',
        'total_employees',
        'total_revenue',
        'total_profit',
        'total_amount_utilized',
        'is_completed',
    );

    public function measure() {
        return $this->belongsTo(PerformanceMeasure::class, 'measure_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function phase() {
        return $this->belongsTo(Phase::class, 'phase_id');
    }

    public function cpmquestionanswers() {
        return $this->hasMany(CpmQuestionAnswer::class, 'cpm_id');
    }
}
