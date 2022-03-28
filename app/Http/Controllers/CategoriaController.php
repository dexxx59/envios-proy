<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show(Categoria $category)
  {
  			$products = $category->prendas()->paginate(10);
  		    return view('categories.show')->with(compact('category','products'));
  }
}
