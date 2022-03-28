@extends('layouts.app')
@section('title', 'Listado de envios')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <div class="row">
                <div class="col-sm-9 text-center">
                    <h2 class="title">Listado de Envios</h2>
                </div>
                <div class="col-sm-3">
                    <a href ="{{ url('/admin/envios/create') }}" class="btn btn-primary btn-just-icon" title="Nueva categoria">
                        <i class="material-icons">note_add</i>
                    </a>                   
                </div>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-info">
                  <strong> {{ Session::get('msg') }}</strong>
                </div>
           
            @endif

            <div class="team">
                <div class="row">  

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Metodo</th>
                                <th class='col-md-5 text-center'>Fecha_envio</th>      
                                <th class='col-md-5 text-center'>Costo_envio</th>                           
                                     
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($envios as $envio)
                        <tr>
                            <td class="text-center">{{ $envios->id }}</td>
                            <td>{{ $envios->metodo }}</td>
                            <td>{{ $envios->fecha_envio }}</td>
                            <td>{{ $envios->costo_envio }}</td>
                            <td class="td-actions text-right">
                              
                              <form method="post" action="{{ url('/admin/cat/envios'.$envios->id ) }}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                                <a  href="{{ url('/admin/envios/'.$envios->id.'/edit') }}" rel="tooltip" title="Editar envio" class="btn btn-success btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>                                   
                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $envios->links() }}
                </div>
            </div>

        </div>


        
    </div>

</div>

@include('includes.footer')
@endsection