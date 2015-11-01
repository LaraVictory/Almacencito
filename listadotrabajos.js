var serviceURL = "http://almacenmultimedia.com.ar/loginapp/";


var id = getUrlVars()["id"];

var trabajos;

$('#trabajos').bind('pageinit', function(event) {
	gettrabajos();
});


function gettrabajos() {
	$.getJSON(serviceURL + 'gettrabajos.php?id='+ id, function(data) {
		$('#listadotrabajos li').remove();
		trabajos = data.item;
		$.each(trabajos, function(index, trabajo) {
			$('#listadotrabajos').append('<li class="boton2"><a href="trabajosView.html?id=' + trabajo.idTrabajo+ '">' +
					'<h4>' + trabajo.tituloTrabajo + '<br/> ' + trabajo.descripcion + '</h4>' +
					'</span></a></li>');
		});
		$('#listadotrabajos').listview('refresh');
	});
}





 function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
