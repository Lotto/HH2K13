$(document).ready(function()
{
    var id = 1;
    $('#ajouter').on('click', function() {

    	$('#boutonFormulaire').removeAttr('disabled');

		var dynamic_div = $(document.createElement('div')).css({ border: '1px dashed', position: 'absolute', left: 10, top: 10, width: '120', height: '120', padding: '3', margin: '0' });
		$(dynamic_div).attr('id', 'sousPhoto'+id);
		$(dynamic_div).attr('class', 'sousPhoto');

		$(dynamic_div).appendTo('#mainPhoto').draggable({containment: "parent"}).resizable(); 
        
        // var draggable = document.getElementById('sousPhoto'+id);
        // var options =  {
        //     moveArea : document.getElementById('mainPhoto')
        // };
        // dragOn.apply( draggable, options );

        // $('#sousPhoto'+id).draggable().resizable();
     //    $('#sousPhoto'+id).draggable({ 
     //    	create: function( event, ui ) {
     //    		$(this).css({
     //        		top: $(this).position().top,
     //        		bottom: "auto"
     //    		});
    	// 	},
    	// 	containment: "parent" 
    	// });
        id = id + 1;
        return false;
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
            return true;
        });
    }
    else {

        alert('Attention, il ne faut pas que tes crops se superposent... :(');
        return false;
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