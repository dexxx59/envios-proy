<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function detalles()
    {
    	return $this->hasMany(PedidoDetalle::class);
    }

    public function getTotalAttribute(){
    	$total =0;
    	foreach ($this->detalles as $detail) {
    		$total += $detail->cantidad * $detail->prenda->precioUnit;	
    	}
    	return $total;

    }
}
