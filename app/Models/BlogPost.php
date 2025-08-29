<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $guarded = [];

    //هنا بيوضح ان البوست الواحدة بيخص كاتوجري معينه بنده على الموديل بتاع الكاتوجري وبحط البريمري 
    // id بتاع الكاتوجري و id بتاع البوست
    public function blog(){
        return $this->belongsTo(BlogCategory::class, 'blogcat_id', 'id');
    }
}
