<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = array(
        'company_id',
        'domain_id',
        'project_title',
        'other_domain',
        'problem_statement',
        'summary_of_solution',
        'expected_results',
        'organizational_expertise'
    );

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }

    public function activities() {
        return $this->hasMany(Activity::class, 'project_id');
    }
}
