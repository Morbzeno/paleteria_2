<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $fillable= ['stock'];
    protected $primaryKey = 'inventory_id';

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
