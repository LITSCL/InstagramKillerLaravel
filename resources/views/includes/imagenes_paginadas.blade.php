<div class="card publicacion">
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
   		<div class="comentarios">
       		<a class="btn btn-warning btn-sm boton-comentario" href="{{ url('/imagen/publicacion/detalle', ['id' => $imagen->id]) }}">
       			Comentarios ({{ count($imagen->getAllComentario) }})<!-- El método "count", permite contar la cantidad de registros. -->
       		</a>
   		</div>
    </div>
</div>