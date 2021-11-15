<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'chapters';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function getCourse(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function cart(){
        return $this->hasMany('App\Models\Cart');
    }

    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}
