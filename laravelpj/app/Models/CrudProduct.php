<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class CrudProduct extends Model
{
    protected $table = 'products';

    use HasFactory;
    protected $fillable = ['name','category_id','descript','quantity','price','image'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}