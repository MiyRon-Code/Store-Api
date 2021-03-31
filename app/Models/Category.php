<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['name','code'];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
