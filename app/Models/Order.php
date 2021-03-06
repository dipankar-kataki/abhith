<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
    public function chapter(){
        return $this->belongsTo('App\Models\Chapter');
    }
}
