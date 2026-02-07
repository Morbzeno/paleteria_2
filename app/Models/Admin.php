<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = ['user_id', 'person_id', 'direction_id', 'payment', 'schedule', 'admin_type'];
    protected $primaryKey = 'admin_id';

    public function admin_payment(){
        return $this->hasOne(Admin_payment::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function direction(){
        return $this->belongsTo(Direction::class, 'direction_id', 'direction_id');
    }

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', "person_id");
    }

}
