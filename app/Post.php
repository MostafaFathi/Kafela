<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function orphan()
    {
        return $this->belongsTo('App\User','orphan_id');
    }
    public function sponsor()
    {
        return $this->belongsTo('App\User','sponsor_id');
    }

    public function getStatusTextAttribute()
    {
        if($this->status == 0){
            return 'جديد';
        }else if($this->status == 1){
            return 'محجوز';
        }else if($this->status == 2){
            return 'تم الشراء';
        }else if($this->status == 2){
            return 'ملغي';
        }
    }
}
