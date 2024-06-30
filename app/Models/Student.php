<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function classEntity()
    {
        return $this->belongsTo(ClassEntity::class, 'admission_class', 'id');
    }

    public function sectionDetails()
    {
        return $this->belongsTo(Section::class, 'section', 'id');
    }
}
