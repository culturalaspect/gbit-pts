<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = array(
        'company_name',
        'ceo_name',
        'address',
        'cell_no',
        'official_email',
        'online_profile_link',
        'total_employees',
        'total_revenue',
        'total_profit',
        'category_id',
        'district_id',
        'is_completed'
    );

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function companyperformancemeasures() {
        return $this->hasMany(CompanyPerformanceMeasure::class, 'company_id');
    }

    public function companyfinancials() {
        return $this->hasMany(CompanyFinancial::class, 'company_id');
    }
}
