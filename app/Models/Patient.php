<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends \Illuminate\Foundation\Auth\User
{
    use HasFactory , Notifiable ;
    use Translatable;
    public $translatedAttributes = ['name', 'address'];
    public $fillable = ['email', 'password', 'date_birth', 'phone', 'gender', 'blood_group'];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function receipt_accounts()
    {
        return $this->hasMany(ReceiptAccount::class,  'patient_id');
    }
}
