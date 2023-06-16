<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_detail extends Model
{
    use HasFactory;
    
    protected $table ='bill_detail';

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'id_bill');
    }
}
