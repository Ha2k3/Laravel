<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table ='products';
    
    public function product_type(){
        return $this->belongsTo('app\type_products');
    }
    public function bill_details(){
        return $this->hasMany('app\bill_detail');
    }
    public function comment(){
        return $this->hasMany('app\comment');
    }
}
