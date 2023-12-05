@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	        <h1>Gente</h1>
	        <form id="buscador" action="" method="GET">
	        	<div class="row">
		        	<div class="form-group col">
			        	<input type="text" id="buscar" class="form-control"/>   
		        	</div> 
		        	<div class="form-group col boton-buscar">
		        		<input class="btn btn-success" type="submit" value="Buscar"/>
		        	</div>   	
	        	</div>
	        </form>
	        
	        <hr/>
	        
        	@include('includes.mensaje')
        	@foreach ($usuarios as $usuario)
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
		        		<a class="btn btn-success" href="{{ route('usuario.vista.perfil', ['id' => $usuario->id]) }}">Ver perfil</a>
		        	</div>
		        </div>
	        @endforeach
        	<!-- Inicio barra de paginación. -->
        	<div class="clearfix">
        		{{ $usuarios->links() }} <!-- Para que la barra de páginas se vea bien, se debe indicar el framework utilizado en el método "boot" ubicado en la clase "app/Providers/AppServiceProvider.php" -->
        	</div>
        	<!-- Fin barra de paginación. -->
        </div>     
    </div>
</div>
@endsection
