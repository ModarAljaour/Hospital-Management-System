<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;

    public $fillable = ['name', 'notes', 'phone', 'email', 'section_id', 'doctor_id', 'type',  'appointment', "date"];





    public  function section()
    {
        return $this->belongsTo(Section::class);
    }

    public  function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
