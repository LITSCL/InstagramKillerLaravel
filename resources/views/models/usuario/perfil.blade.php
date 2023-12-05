@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">    
	        <div class="perfil-usuario">
	        	@if ($usuario->imagen)
		        	<div class="contenedor-avatar">
		        		<img class="avatar" src="{{ url('usuario/avatar/' . $usuario->imagen) }}"/>
		        	</div>    			
        		@endif
	        	<div class="informacion">
	        		<h1>{{ "@" . $usuario->alias }}</h1>
	        		<h2>{{ $usuario->nombre . " " . $usuario->apellido }}</h2>
					{{ "Se unió: " . \FormatearFecha::filtrarTiempoTranscurrido($usuario->created_at) }}   
	        	</div>
	        </div>
	        
	        <div class="clearfix"></div>
	        
	        <hr/>

        	@foreach ($usuario->getAllImagen as $imagen)
            	@include('includes.imagenes_paginadas', ['imagen' => $imagen])
        	@endforeach
        </div>     
    </div>
</div>
@endsection
