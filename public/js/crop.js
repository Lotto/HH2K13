$(document).ready(function()
{
	var id=1;
	$('#ajouter').on('click', function() {

		$('#mainPhoto').append($('<div class="sousPhoto" id="sousPhoto'+id+'"></div>'));
		var draggable = document.getElementById('sousPhoto'+id);
		var options =  {
			moveArea : document.getElementById('mainPhoto'),
			cssPosition : 'fixed',
		};
		dragOn.apply( draggable, options );

		$('#sousPhoto'+id).resizable();
		id = id + 1;
	});
});

function genererFormulaire(){ 

	var positionMaster = $('#mainPhoto').offset();

	if ( verifierSousPhotos() ) {

		$('.sousPhoto').each(function(i){

			var id = i + 1;
			var sousPhoto = document.getElementById('sousPhoto'+id);
			var positionSousPhoto = $('#sousPhoto'+id).offset();

			var top = positionSousPhoto.top - positionMaster.top;
			var left = positionSousPhoto.left - positionMaster.left;

			$('#form').append($('<input type="hidden" name="photos' + id + '[top]" value="' + top + '">'));
			$('#form').append($('<input type="hidden" name="photos' + id + '[left]" value="' + left + '">'));

			var width = $('#sousPhoto'+id).width();
			var height = $('#sousPhoto'+id).height();
			$('#form').append($('<input type="hidden" name="photos' + id + '[width]" value="' + width + '">'));
			$('#form').append($('<input type="hidden" name="photos' + id + '[height]" value="' + height + '">'));
		}); 
	}
	else {

		alert('KO');
	}
}

function verifierSousPhotos(){ 

	var valide = true;

	$('.sousPhoto').each(function(i){

		var id = i + 1;
		var sousPhoto = document.getElementById('sousPhoto'+id);

		$('.sousPhoto').each(function(j){

			var idJ = j + 1;
			var autreSousPhoto = document.getElementById('sousPhoto'+idJ);

			if ( i != j ) {
				if ( isOver(sousPhoto, autreSousPhoto) ) {
					valide = false;
				}
			}
		}); 
	}); 

	return valide;
}