<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Doctor extends User
{
    use HasFactory, Notifiable;

    use Translatable;
    protected $translatedAttributes = ['name', 'appointment'];
    public $fillable = ['name', 'email', 'email_verified_at', 'password', 'phone', 'section_id', 'status', 'number_of_statements'];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Time::class, 'time_doctor');
    }
}
/*


*/
