<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['metodo', 'fecha_envio','costo_envio'];

    public static $rules = [
   		'metodo' => 'required|min:3',
   		'fecha_envio',
           'costo_envio'
    ];
    public function pedido()
    {
    	return $this->hasMany(Pedido::class); //una categoria tiene muchos productos
    }
    
}

