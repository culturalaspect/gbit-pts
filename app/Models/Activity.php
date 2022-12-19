<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = array(
        'project_id',
        'activity_title',
        'methodology',
        'start_date',
        'end_date',
        'status',
        'deliverable',
        'result',
        'is_deadline_set'
    );

    public static function statuses()
    {
        return collect(
            [
                ['status' => 0,  'label' => 'In Progress'],
                ['status' => 1,  'label' => 'Completed'],
                ['status' => 2,  'label' => 'N/A'],
            ]
        );
    }

    public function project() {
        return $this->belongsTo(Project::class, 'company_id');
    }
}
