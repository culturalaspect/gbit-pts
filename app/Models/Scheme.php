<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    use HasFactory;

    protected $fillable = array('scheme_name', 'sanctioned_amount', 'date_of_sanction', 'description');

    public function phases() {
        $this->hasMany(Phase::class, 'schema_id');
    }
}
