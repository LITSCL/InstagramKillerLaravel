@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<div class="card">
        		<div class="card-header">Subir nueva imagen</div>
        		<div class="card-body">
        			<form action="{{ route('imagen.accion.save') }}" method="POST" enctype="multipart/form-data">
        			
        				@csrf
        				<div class="form-group row">
        					<label class="col-md-2 col-form-label" for="imagen">Imagen</label>
        					<div class="col-md-7">
        						<input class="form-control" type="file" name="imagen" required/>
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
        						<textarea class="form-control" name="descripcion" required/></textarea>
        						@error('descripcion')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        					</div>
        				</div>
        				
        				<div class="form-group row mt-2">	
        					<div class="col-md-6 offset-md-2">
        						<input class="btn btn-primary" type="submit" value="Subir"/>
        					</div>
        				</div>
        				
        			</form>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection