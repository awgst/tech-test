<?php

namespace App\Models\Assesment;

use App\Constants\AssesmentType;
use App\Models\Scopes\Assesment\EssayScope;

class Essay extends Assesment
{
    public function getType(): string
    {
        return AssesmentType::ESSAY;
    }

    public static function boot()
    {
        static::addGlobalScope(new EssayScope);
        static::creating(function ($model) {
            $model->types = AssesmentType::QUIZ;
        });

        parent::boot();
    }
}