<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update()
 	{
 		$client = auth()->user(); 
    	$cart = $client->cart;
    	$cart->estado = 'Pending';
    	$cart->fecha_reserva = Carbon::now();
    	$cart->save();

    	$admins = User::where('admin', true)->get();
        //Aqui podemos agregar copia del correo para el cliente,
        //para pruebas solo envía al correo del admin
    	
        //Mail::to($admins)->send(new NewOrder($client, $cart));

    	$msg = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail!';
    	return back()->with(compact('msg'));
		
 	}
}
