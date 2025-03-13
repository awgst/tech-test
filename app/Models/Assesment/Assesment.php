<?php

namespace App\Models\Assesment;

use App\Constants\AssesmentType;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Assesment extends Model implements HasGradeWeight
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

    public function getGradeWeight()
    {
        return 1;
    }

    public function toType()
    {
        switch ($this->types) {
            case AssesmentType::EXAM:
                return new Exam($this->toArray());
            case AssesmentType::QUIZ:
                return new Quiz($this->toArray());
            case AssesmentType::ESSAY:
                return new Essay($this->toArray());
        }
    }
}
