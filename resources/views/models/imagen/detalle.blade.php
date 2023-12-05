@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        	@include('includes.mensaje')
        	<div class="card publicacion publicacion-detalle">
                <div class="card-header">
                    <div class="contenedor-avatar-publicacion">
                        @if ($imagen->getUsuario->imagen)
                    		<img class="avatar" src="{{ url('usuario/avatar/' . $imagen->getUsuario->imagen) }}"/>
                    	@endif
                    </div>
                	<div class="contenedor-publicacion-datos">
			        	<a href="{{ url('/usuario/perfil', ['id' => $imagen->getUsuario->id]) }}">		
			        		{{ $imagen->getUsuario->nombre . " " . $imagen->getUsuario->apellido }}
			        		<span class="alias">
			        			 {{ " | @" . $imagen->getUsuario->alias}}
			        		</span>	
			        	</a>
                	</div>			
                </div>

                <div class="card-body">
                    <div class="contenedor-publicacion-imagen">
                    	<img src="{{ url('imagen/publicacion/' . $imagen->imagen) }}"/>
                    </div>				
               		<div class="descripcion">
               			<span class="alias">
               				{{ "@" . $imagen->getUsuario->alias }}
               			</span>     
               			<span class="fecha">
                   			{{ " | " . \FormatearFecha::filtrarTiempoTranscurrido($imagen->created_at) }}   
                   		</span>              			
               			<p>
               				{{ $imagen->descripcion }}
               			</p>	
               		</div>
					<div class="likes">
                   		
               			<!-- Comprobar si el usuario dió like a la imagen. -->
               			<?php $usuarioLike = false ?>
               			@foreach ($imagen->getAllLike as $like)
               				@if ($like->getUsuario->id == Auth::user()->id)
               					<?php $usuarioLike = true ?>
               					@break
               				@endif
               			@endforeach
               			
               			@if ($usuarioLike == true)
               				<img class="btn-like" data-idImagen="{{ $imagen->id }}" src="{{ asset('img/heart-red.png') }}"/> <!-- El método "asset" permite acceder a la carpeta "public" de Laravel. -->
               			@else
               				<img class="btn-dislike" data-idImagen="{{ $imagen->id }}" src="{{ asset('img/heart-gray.png') }}"/>
               			@endif
               			
               			<span class="numero-like">{{ count($imagen->getAllLike) }}</span>
                   			
                   	</div>  
                   	@if (Auth::user() && Auth::user()->id == $imagen->getUsuario->id)
	                   	<div class="acciones">
	                   		<a class="btn btn-warning btn-sm" href="{{ route('imagen.vista.editar', ['id' => $imagen->id]) }}">Modificar</a>

							<!-- Lanzador del Modal. -->
							<button type="button" class="btn btn-danger btn-sm"
								data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
	
							<!-- Modal. -->
							<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalEliminarLabel">Advertencia</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">¿Seguro que deseas eliminar esta imagen?</div>
										<div class="modal-footer">
											<a class="btn btn-danger" href="{{ route('imagen.accion.delete', ['id' => $imagen->id]) }}">Eliminar</a>
											<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
	                @endif
                   		
               		<div class="clearfix"></div>
               		    		
               		<div class="comentarios">
						<h2>Comentarios ({{ count($imagen->getAllComentario) }})</h2><!-- El método "count", permite contar la cantidad de registros. -->
               			
               			<hr/>
               			
               			<form action="{{ route('comentario.accion.save') }}" method="POST">
               				@csrf
               				<input type="hidden" name="imagenId" value="{{ $imagen->id }}" required/>
               				
               				<textarea class="form-control @error('contenido') is-invalid @enderror" name="contenido" required></textarea>
           				    @error('contenido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
               				<button class="btn btn-success mt-3" type="submit">Enviar</button>
               			</form>
               			
               			<hr/>
               			
               			@foreach ($imagen->getAllComentario as $comentario)
               				<div class="comentario">	               		
                       			<span class="alias">
                       				{{ "@" . $comentario->getUsuario->alias }}
                       			</span>     
                       			<span class="fecha">
                           			{{ " | " . \FormatearFecha::filtrarTiempoTranscurrido($comentario->created_at) }}   
                           		</span>              			
                       			<p>
                       				{{ $comentario->contenido }}
                       			</p>
                       			<!-- Verificar si hay alguien logeado, si el comentario pertenece al logeado o si el logeado fue quien realizó la publicación. -->
                       			@if (Auth::check() && $comentario->usuario_id == Auth::user()->id || $comentario->getImagen->usuario_id == Auth::user()->id)
                           			<a class="btn btn-sm btn-danger" href="{{ route('comentario.accion.delete', ['id' => $comentario->id]) }}">
                           				Eliminar
                           			</a>
                       			@endif
               				</div>
               			@endforeach
               		</div>
                </div>
            </div>
        </div>     
    </div>
</div>
@endsection