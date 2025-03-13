<?php

use App\Constants\AssesmentType;
use App\Models\Assesment\Essay;
use App\Models\Assesment\Exam;
use App\Models\Assesment\Quiz;

class CreateAssesmentObject
{
    public static function create($type, $data) 
    {
        switch ($type) {
            case AssesmentType::QUIZ:
                return (new Quiz())->fill($data);
                break;
            case AssesmentType::EXAM:
                return (new Exam())->fill($data);
                break;
            case AssesmentType::ESSAY:
                return (new Essay())->fill($data);
                break;
            default:
                throw new \Exception('invalid type', 400);
                break;
        }
    }
}