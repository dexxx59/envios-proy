<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnvioController extends Controller
{
    public function show(Envio $envio)
    {
                $products = $envio->prendas()->paginate(10);
                return view('envios.show')->with(compact('envios','products'));
    }
}
