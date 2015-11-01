<?php
header('Content-Type: text/javascript; charset=UTF-8'); 
$resultados = array();
$conexion = mysqli_connect("localhost", "webproye_npotasc", "kpwi792q", "webproye_ejemplo");

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

/* revisar existencia del usuario con la contraseña en la bd */
$sqlCmd = "SELECT nombreUsuario, pass, idUsuario
FROM usuarios
WHERE nombreUsuario
LIKE '".mysqli_real_escape_string($conexion,$usuarioEnviado)."' 
AND pass ='".mysqli_real_escape_string($conexion,$passwordEnviado)."'
LIMIT 1";

$sqlQry = mysqli_query($conexion,$sqlCmd);

if(mysqli_num_rows($sqlQry)>0){

	$login=1;



	$fila = mysqli_fetch_array($sqlQry); //hago esto para poder extraer el id usuario que peciso.

	$idUsuario =  $fila["idUsuario"];


	// nueva consulta para listar proyectos en base al id del usuario que se registro.


	$sqlP = "SELECT * FROM trabajos where idUsuario = '$idUsuario'";
	$sqlQryP = mysqli_query($conexion,$sqlP);

	

	while ($r = mysqli_fetch_assoc($sqlQryP)){ // tiene q ser assoc para que no me cree arrays multimedimensional, probar que muestra un echo con array y otro con assoc
		
	
		$resultados[] = $r;
	
	}
	
	//echo json_encode($array);

	

}else{

	$login=0;


}




$resultados["validacion"] = "neutro";



if( $login==1 ){



$resultados["validacion"] = "ok";


}else{


$resultados["validacion"] = "error";
}


$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>