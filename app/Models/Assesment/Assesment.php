<?php

namespace App\Models\Assesment;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Assesment extends Model
{
    protected $fillable = ['course_id', 'student_id', 'types', 'scores'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
