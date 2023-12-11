<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $table = "employee";
    protected $fillable= [
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'image',
        'dob',
        'department',
        'doj',
        'designation',
    ];


    

}   

