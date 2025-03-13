<?php

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('types', ['quiz', 'exam', 'essay']);
            $table->decimal('scores', 5, 2);
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')
                ->on($this->courseTable())
                ->onDelete('cascade');
            $table->foreign('student_id')
                ->references('id')
                ->on($this->studentTable())
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assesments');
    }

    private function courseTable(): string
    {
        return (new Course())->getTable();
    }

    private function studentTable(): string
    {
        return (new Student())->getTable();
    }
};
