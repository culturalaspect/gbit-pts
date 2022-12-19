<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = array('domain_name', 'description');

    public function projects() {
        $this->hasMany(Project::class, 'domain_id');
    }
}
