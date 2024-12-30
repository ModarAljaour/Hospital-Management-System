<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAccount extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['description'];
    protected $fillable = ['date', 'Debit', 'patient_id '];

    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
