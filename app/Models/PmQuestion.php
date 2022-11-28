<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmQuestion extends Model
{
    use HasFactory;

    protected $fillable = array('measure_id', 'question', 'question_type', 'is_required');

    public function measure() {
        return $this->belongsTo(PerformanceMeasure::class, 'measure_id');
    }

    public function pmquestionoptions(){
        return $this->hasMany(PmQuestionOption::class, 'pm_question_id');
    }

    public function cpmquestionanswers() {
        return $this->hasMany(CpmQuestionAnswer::class, 'pm_question_id');
    }

}
