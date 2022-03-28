<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Categoria::class);
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->nombre();
        else
            return 'General';
    }

}
