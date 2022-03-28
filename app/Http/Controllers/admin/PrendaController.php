<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\PedidoDetalle;
use App\Models\Prenda;
use App\Models\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrendaController extends Controller
{
    private $validar = [
        'prenda' => 'required',
        'imagen' => 'required|image|mimes:png,jpg,jpeg,gif',
        'stock' => 'required | numeric | min:5',
        'precioUnit' => 'required',
        'color_id' => 'required',
        'talla_id' => 'required',
        'marca_id' => 'required',
        'tipoPrenda_id' => 'required',
    ];
    private $validarEdit = [
        'prenda' => 'required',
        'imagen' => 'image|mimes:png,jpg,jpeg,gif',
        'stock' => 'required | numeric | min:5',
        'precioUnit' => 'required',
        'color_id' => 'nullable',
        'talla_id' => 'nullable',
        'marca_id' => 'nullable',
        'tipoPrenda_id' => 'nullable',
    ];

    public function index(Request $res){
   	    $prendas = Prenda::paginate(10);
        return view('admin.products.index')->with(compact('prendas'));
    }

    public function create(){
        $marcas = Marca::all();
        $colors = Color::all();
        $tallas = Talla::all();
        $categories = Categoria::orderBy('nombre')->get();
        return view('admin.products.create')->with(compact('categories', 'marcas', 'colors', 'tallas'));
    }

    public function store(Request $request){

        $request->validate($this->validar);

        $prenda = new prenda();
        $prenda->tipoPrenda_id = $request->tipoPrenda_id;
        $prenda->marca_id = $request->marca_id;
        $prenda->color_id = $request->color_id;
        $prenda->talla_id = $request->talla_id;
        $prenda->prenda = $request->prenda;
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath = 'imagenes/prendas/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $prenda->imagen = $destinationPath . $filename;
        }
        $prenda->stock = $request->stock;
        $prenda->precioUnit = $request->precioUnit;
        $prenda->save();
        return redirect()->route('admin/products');
    }

    public function edit($id){
        
        $categories = Categoria::orderBy('name')->get();
        $marcas = marca::all();
        $colors = Color::all();
        $tallas = talla::all();
        $prendaEdit = prenda::find($id);
        return view('admin.products.edit')->with(compact('prendaEdit', 'categories', 'marcas', 'colors', 'tallas'));
    }

    public function update(Request $request, $id)
    {
        $post = prenda::find($id);
        $request->validate($this->validarEdit);
        if($request->prenda){
            $post->prenda = $request->prenda;
        }
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath = 'imagenes/prendas/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $post->imagen = $destinationPath . $filename;
        }
        $post->save();
        return redirect()->route('admin/products');
    }

    public function destroy($id)  
   {
      PedidoDetalle::where('product_id', $id)->delete();
      //ProductImage::where('product_id', $id)->delete();

   		$product = Prenda::find($id);
   		$product->delete();
   		
      Session::flash('msg', 'Se eliminó el producto y las imágenes asociadas');
   		return back();
   }
    
}
