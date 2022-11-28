<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = array('phase_name', 'scheme_id', 'date_from', 'date_to', 'is_active');

    public function scheme() {
        return $this->belongsTo(Scheme::class, 'scheme_id');
    }

    public function companies() {
        return $this->hasMany(Company::class, 'phase_id');
    }

    public function companyfinancials() {
        return $this->hasMany(CompanyFinancial::class, 'phase_id');
    }
}
