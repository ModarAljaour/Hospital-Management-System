<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
    public function ReceiptAccount()
    {
        return $this->belongsTo(ReceiptAccount::class, 'receipt_id');
    }
    
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

}
