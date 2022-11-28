<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = array('pm_question_id', 'option_text');

    public function pmquestion() {
        return $this->belongsTo(PmQuestion::class, 'pm_question_id');
    }

}
