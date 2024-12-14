<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', 
        'type', 
        'document_number'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
