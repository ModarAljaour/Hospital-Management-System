<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use Translatable;
    protected $translatedAttributes = ['name', 'appointment'];
    use HasFactory;
    public $fillable = ['name'];


}
