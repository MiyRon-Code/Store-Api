<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','description','price','category_id'];
    protected $guarded  = ['id', 'created_at','updated_at']; 
    public function category()
    {
        return $this->belongsTo(Category::class);
        $this->category_id = $this->category();
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
        $this->category_id = $this->category();
    }
    
}
