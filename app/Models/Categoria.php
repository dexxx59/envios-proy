<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'description'];

    public static $rules = [
   		'nombre' => 'required|min:3',
   		'description' => 'max:250'
    ];

    public function prendas()
    {
    	return $this->hasMany(Prenda::class); //una categoria tiene muchos productos
    }

    public function getFeaturedImageUrlAttribute()
    {
      if($this->image){
          return '/images/categories/' . $this->image;
      }else{

        $firstProduct = $this->prendas()->first();    
        if($firstProduct)   
            return $firstProduct->featured_image_url;
          else
            return '/images/default.png';
      }
    }
}
