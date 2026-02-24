<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    
    protected $table = 'ingredients';
    protected $fillable= ['name', 'description', 'price', 'supplier_id', 'image', 'video_path'];
    protected $primaryKey = 'ingredient_id';

    public function order_detail(){
        return $this->hasMany(Order_detail::class);
    }

    public function inventory(){
         return $this->hasOne(Inventory::class, 'ingredient_id', 'ingredient_id');
    }

    public function suppliers(){
        return $this->belongsTo(Supply::class, 'supplier_id', 'supplier_id');
    }
}
