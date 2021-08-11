/*********************** Funciones creacion de linea *****************************************/
$(document).ready(function(){
	$('.js-example-basic-multiple').select2();
	//alert('Documento cargado');
});

function vistaPrevia(){
	var reader = new FileReader();
	//Captura el contenido del input por medio de su id
	reader.readAsDataURL(document.getElementById('linimagen').files[0]);
	//Desplegar la imagen en la vista previa
	reader.onload = function(e){
		document.getElementById('uploadPreview').src = e.target.result;
	}
}
function vistaPreviaEdit(){
	var reader = new FileReader();
	//Captura el contenido del input por medio de su id
	reader.readAsDataURL(document.getElementById('linimagenedit').files[0]);
	//Desplegar la imagen en la vista previa
	reader.onload = function(e){
		document.getElementById('uploadPreview').src = e.target.result;
	}
}
/*****************************************************************************************/
function soloNumeros(e)
{
	var key = window.event ? e.keyCode : e.which;
	if ((48 <= key && key <= 57) || (key == 0) || (key == 8))
	{ return true; } else { return false; }
}

function soloNumerosFlotantes(e)
{
	var key = window.event ? e.keyCode : e.which;
	if ((48 <= key && key <= 57) || (key == 0) || (key == 8) || (key ==46)||(key == 44))
	{ return true; } else { return false; }
}

function noContenido(e)
{
	var key = window.event ? e.keyCode : e.which;
	if ((48 <= key && key <= 57) || (key == 0) || (key == 8) || (key ==46)||(key ==44))
	{ return false; } else { return false; }
}