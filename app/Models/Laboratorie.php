<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function employee()
    {
        return $this->belongsTo(RayEmployee::class, 'employee_id')
            // if name have null value
            ->withDefault(['name' => 'No Employee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class,  'imageable');
    }
}
