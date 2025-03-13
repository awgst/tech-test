<?php

namespace App\Constants;

class AssesmentType
{
    const QUIZ = 'quiz';
    const EXAM = 'exam';
    const ESSAY = 'essay';

    public static function toArray(): array
    {
        return [
            self::QUIZ,
            self::EXAM,
            self::ESSAY,
        ];
    }
}