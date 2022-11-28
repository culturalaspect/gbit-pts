<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = array('category_name', 'description');

    public function companies() {
        $this->hasMany(Company::class, 'category_id');
    }
}
