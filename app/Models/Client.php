<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable= ['client_type'];
    protected $primaryKey = 'client_id';

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function direction(){
        return $this->belongsTo(Direction::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
