<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direction extends Model
{
    protected $table = 'directions';
    protected $fillable= ['street', 'colony', 'city', 'postal_code'];
    protected $primaryKey = 'direction_id';

    public function admin(){
        return $this->hasOne(Admin::class, 'direction_id', 'direction_id');
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

}
