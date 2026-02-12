<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable= ['total_price', 'deliver_status'];
    protected $primaryKey = 'order_id';

    public function order_details(){
        return $this->hasMany(Order_detail::class); 
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
