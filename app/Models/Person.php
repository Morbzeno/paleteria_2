<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable= ['name', 'last_name', 'rfc', 'phone_number', 'email_adress'];
    protected $primaryKey = 'person_id';
    
    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function client(){
        return $this->hasOne(Client::class);
    }
}
