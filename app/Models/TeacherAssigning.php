<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherAssigning extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $model) {
            $model->academicYear()->associate(AcademicYear::getCurrent());
        });
    }

    protected $fillable = [
        'teacher_id',
        'section_id',
        'subject_id',
        'academic_year_id',
        'user_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
