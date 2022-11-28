<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpmQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = array('cpm_id', 'pm_question_id', 'pm_answer');

    public function cpm() {
        return $this->belongsTo(CompanyPerformanceMeasure::class, 'cpm_id');
    }

    public function pmquestion(){
        return $this->belongsTo(PmQuestion::class, 'pm_question_id');
    }

}
