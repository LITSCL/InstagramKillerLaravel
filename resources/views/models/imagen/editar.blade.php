@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<div class="card">
        		<div class="card-header">Editar la imagen</div>
        		<div class="card-body">
        			<form action="{{ route('imagen.accion.update') }}" method="POST" enctype="multipart/form-data">
        			
        				@csrf
        				<input type="hidden" name="idImagen" value="{{ $imagen->id }}" />
        				<div class="form-group row">
        					<label class="col-md-2 col-form-label" for="imagen">Imagen</label>
        					<div class="col-md-7">
	        					 <div class="contenedor-imagen-editar">
			                        @if ($imagen->imagen)
			                    		<img src="{{ url('imagen/publicacion/' . $imagen->imagen) }}"/>
			                    	@endif
			                    </div>
        						<input class="form-control" type="file" name="imagen"/>
        						@error('imagen')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        					</div>
        				</div>
        				
        				<div class="form-group row mt-2">
        					<label class="col-md-2 col-form-label" for="descripcion">Descripción</label>
        					<div class="col-md-7">
        						<textarea class="form-control" name="descripcion" required/>{{ $imagen->descripcion }}</textarea>
        						@error('descripcion')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        					</div>
        				</div>
        				
        				<div class="form-group row mt-2">	
        					<div class="col-md-6 offset-md-2">
        						<input class="btn btn-primary" type="submit" value="Actualizar"/>
        					</div>
        				</div>
        				
        			</form>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection