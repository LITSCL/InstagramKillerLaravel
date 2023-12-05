var url = "http://localhost/InstagramKillerLaravel/public/";

window.addEventListener("load", function() {
	
	try {
		var form_buscador = document.getElementById("buscador");
		var input_buscar = document.getElementById("buscar");
		
		form_buscador.addEventListener("submit", function() {
			this.setAttribute("action", url + "usuarios/" + input_buscar.value);
		});	
	} catch (error) {
		
	}
	
	var img_btnLike = document.querySelectorAll(".btn-like");
	var img_btnDislike = document.querySelectorAll(".btn-dislike");
	
	function darLike() {
		img_btnLike = document.querySelectorAll(".btn-like");
		img_btnDislike = document.querySelectorAll(".btn-dislike");
		for (var i = 0; i < img_btnDislike.length; i++) {
			img_btnDislike[i].style.cursor = "pointer"; 
			img_btnDislike[i].addEventListener("click", function like() {
				this.removeEventListener("click", like); //Se debe borrar el listener anterior (Si no se hace tiene 2 eventos iguales y se duplican las instrucciones).
				console.log("Diste like");
				this.setAttribute("class", "btn-like");
				this.setAttribute("src", url + "img/heart-red.png");
				darDislike();	
				
				fetch(url + "like/guardar/" + this.getAttribute("data-idImagen"), {
		            method: "GET",
		            headers: {
		                "Content-Type": "application/json"
		            },
		        })
		        .then(function(response) {
		            return response.json(); //Se convierte la respuesta del servidor a JSON.
		        })
		        .then(function(datos) {
		        	console.log(datos); //Se imprime la respuesta del servidor.
		        });	
			});	
		}
	}
	
	function darDislike() {
		img_btnLike = document.querySelectorAll(".btn-like");
		img_btnDislike = document.querySelectorAll(".btn-dislike");
		for (var i = 0; i < img_btnLike.length; i++) {
			img_btnLike[i].style.cursor = "pointer";
			img_btnLike[i].addEventListener("click", function dislike() {
				this.removeEventListener("click", dislike); //Se debe borrar el listener anterior (Si no se hace tiene 2 eventos iguales y se duplican las instrucciones).
				console.log("Diste dislike");
				this.setAttribute("class", "btn-dislike");
				this.setAttribute("src", url + "img/heart-gray.png");
				darLike();
				
				fetch(url + "like/borrar/" + this.getAttribute("data-idImagen"), {
		            method: "GET",
		            headers: {
		                "Content-Type": "application/json"
		            },
		        })
		        .then(function(response) {
		            return response.json(); //Se convierte la respuesta del servidor a JSON.
		        })
		        .then(function(datos) {
		        	console.log(datos); //Se imprime la respuesta del servidor.
		        });	
			});	
		}
	}
	
	darLike();
	darDislike();
});