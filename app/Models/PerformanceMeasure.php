<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceMeasure extends Model
{
    use HasFactory;

    protected $fillable = array('measure_name', 'date_from', 'date_to', 'is_active', 'description');

    public function companyperformancemeasures() {
        return $this->belongsTo(CompanyPerformanceMeasure::class, 'measure_id');
    }

    public function pmquestions() {
        return $this->hasMany(PmQuestion::class, 'measure_id');
    }

}
