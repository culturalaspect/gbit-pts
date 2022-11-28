<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = array('district_name', 'description');

    public function companies() {
        $this->hasMany(Company::class, 'district_id');
    }
}
