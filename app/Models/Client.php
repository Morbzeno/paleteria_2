<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    
    protected $table = 'clients';
    protected $fillable= ['user_id', 'person_id', 'direction_id', 'client_type'];
    protected $primaryKey = 'client_id';

    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function direction(){
        return $this->belongsTo(Direction::class, 'direction_id', 'direction_id');
    }

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', "person_id");
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
