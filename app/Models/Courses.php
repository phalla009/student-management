<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Event\Telemetry\Duration;

class Courses extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'syllabus', 'duration'];

    // Import and use HasFactory
    use HasFactory;
    // public function duration()
    // {
    //     return $this->duration."Months";
    // }
}
