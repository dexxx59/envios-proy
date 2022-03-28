<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
    	$cartDetail = new PedidoDetalle();
    	$cartDetail->pedido_id = auth()->user()->cart->id;
    	$cartDetail->prenda_id= $request->prenda_id;
    	$cartDetail->cantidad = $request->cantidad;
    	$cartDetail->save();

    	$msg ="Producto agregado al carrito";
    	return back()->with(compact('msg'));

    }	

      public function destroy(Request $request)
    {
    	$cartDetail =  PedidoDetalle::find($request->cart_detail_id);  
    	if($cartDetail->pedido_id == auth()->user()->cart->id) 	
    		$cartDetail->delete();

    	$msg ="Producto eliminado del carrito";
    	return back()->with(compact('msg'));

    }	
}
