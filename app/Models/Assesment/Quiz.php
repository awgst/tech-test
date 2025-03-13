<?php

namespace App\Models\Assesment;

use App\Constants\AssesmentType;
use App\Models\Scopes\Assesment\QuizScope;

class Quiz extends Assesment
{
    public function getType(): string
    {
        return AssesmentType::QUIZ;
    }

    public static function boot()
    {
        static::addGlobalScope(new QuizScope);
        static::creating(function ($model) {
            $model->types = AssesmentType::QUIZ;
        });

        parent::boot();
    }
}