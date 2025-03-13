<?php

namespace App\Models;

use App\Models\Assesment\Assesment;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'final_grade', 'final_grade_letter'];

    public function assesments()
    {
        return $this->hasMany(Assesment::class);
    }
}
