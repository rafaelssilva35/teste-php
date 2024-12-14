<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'supplier_id',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
