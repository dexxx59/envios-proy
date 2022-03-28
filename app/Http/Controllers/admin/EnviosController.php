<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Prenda;
use App\Models\Envio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class EnviosController extends Controller
{
    public function index() 
   {
   	$envio = Envios::orderBy('id')->paginate(10);
   		return view('admin.envios.index')->with(compact('envios'));
   }
   public function create()
   {
   		return view('admin.envios.create');
   }
   public function store(Request $request)
   { 
   	$this->validate($request, Envios::$rules);

   $envio =	Envios::create($request->only('metodo','fecha_envio','costo_envio'));
   return redirect('admin/envios');
    }
    public function edit(Envios $envio) 
   {   		
   		return view('admin.envios.edit')->with(compact('envio'));
   }
   public function update(Request $request, Envios $envio) 
   {
	
   	$this->validate($request, Envios::$rules);
       $envio->update($request->only('metodo','fecha_envio','costo_envio')); 
       return redirect('admin/envios');
   }
   public function destroy(Envios $envios)  
   {
   		$msg='';
      $cont = Prenda::where('pedido_id', $envio->id)->count();
      if ($cont <= 0){
   		   $envio->delete();
         $msg ="Categoria eliminada";
       }else{
        $msg ="No es posible eliminar la categoria porque tiene productos relacionados";
       }

   		Session::flash('msg', $msg);
   		return back();
   }
}