<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Category extends Model
{
    use HasFactory;
    use Loggable;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function checkins()
    {
        return $this->hasMany(Checkin::class,'category_id','id');
    }



   // public function brands()
   // {
   //     return $this->hasMany(Brand::class,'category_id','id')->where('status', '0');
    //}
}
