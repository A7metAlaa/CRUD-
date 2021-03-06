<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use softDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];


    public function user(){

        return $this->hasOne(User::class,'id','user_id');
                    //id in categoeries table and user_id in categories table

    }


}
