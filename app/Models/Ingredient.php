<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    protected $table = 'ingredients';
    protected $fillable= ['name', 'descripcion', 'price'];
    protected $primaryKey = 'ingredient_id';

    public function order_detail(){
        return $this->hasMany(Order_detail::class);
    }

    public function inventory(){
        return $this->hasOne(Inventory::class);
    }

    public function suppliers(){
        return $this->belongsTo(Supply::class);
    }
}
