<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'carts';
    protected $fillable = ['user_id','chapter_id','course_id','is_paid'];

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
}
