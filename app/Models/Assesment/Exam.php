<?php

namespace App\Models\Assesment;

use App\Constants\AssesmentType;
use App\Models\Scopes\Assesment\ExamScope;

class Exam extends Assesment
{
    public function getType(): string
    {
        return AssesmentType::EXAM;
    }

    public static function boot()
    {
        static::addGlobalScope(new ExamScope);
        static::creating(function ($model) {
            $model->types = AssesmentType::QUIZ;
        });

        parent::boot();
    }
}