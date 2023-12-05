@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@include('includes.mensaje')
        	@foreach ($imagenes as $imagen)
            	@include('includes.imagenes_paginadas', ['imagen' => $imagen])
        	@endforeach
        	<!-- Inicio barra de paginación. -->
        	<div class="clearfix">
        		{{ $imagenes->links() }} <!-- Para que la barra de páginas se vea bien, se debe indicar el framework utilizado en el método "boot" ubicado en la clase "app/Providers/AppServiceProvider.php" -->
        	</div>
        	<!-- Fin barra de paginación. -->
        </div>     
    </div>
</div>
@endsection
