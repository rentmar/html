function vistaPrevia(){
	var reader = new FileReader();
	//Captura el contenido del input por medio de su id
	reader.readAsDataURL(document.getElementById('linimagen').files[0]);
	//Desplegar la imagen en la vista previa
	reader.onload = function(e){
		document.getElementById('uploadPreview').src = e.target.result;
	}
}
