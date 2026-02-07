<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail extends Model
{
    protected $table = 'order_details';
    protected $fillable= ['quantity', 'price'];
    protected $primaryKey = 'order_detail_id';

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
}
