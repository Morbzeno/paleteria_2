<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes;
    protected $table = 'supplies';
    protected $fillable= ['name', 'phone_number', 'description', 'last_supply'];
    protected $primaryKey = 'suppy_id';

    public function ingredients(){
        return $this->hasMany(Ingredients::class);
    }
}
