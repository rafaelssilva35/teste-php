<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'name',
        'email',
        'phone'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
