<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];

    //هنا في علاقه بين البوست والكاتوجري بتاعته فالميثود دي بتوضح ان الكاتوجري الواحده ليها اكتر من بوست جوا الميثود بنده على الموديل بتاع البوست وبديله البريمري id اللي انا كتباه الخاص ب id بتاع الكاتوجري
    public function posts(){
        return $this->hasMany(BlogPost::class, 'blogcat_id');
    }

}
