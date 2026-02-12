<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin_payment extends Model
{
    use SoftDeletes;
    protected $table = 'admin_payments';
    protected $fillament = ['pay', 'payment_date', 'next_payment'];
    protected $primaryKey = 'admin_payment__id';

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

}
