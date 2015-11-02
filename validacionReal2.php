<?php

$conexion = mysqli_connect("localhost", "webproye_npotasc", "kpwi792q", "webproye_ejemplo");

	

/* Extrae los valores enviados desde la aplicacion movil */

$comentarioEnviado = $_GET['comentario'];

$trabajoEnviado = $_GET['numerodeltrabajo'];





/* revisar existencia del usuario con la contraseña en la bd */



$sqlCmd = "INSERT INTO comentarios (textoComentario, numeroTrabajo)VALUES ('$comentarioEnviado', '$trabajoEnviado');";



$sqlQry = mysqli_query($conexion,$sqlCmd);


$resultados = array();





/* verifica que el usuario y password concuerden correctamente */


/*esta informacion se envia solo si la validacion es correcta */

$resultados["mensaje"] = "Comentario Enviado";



if($sqlQry ==1){

$resultados["validacion"] = "ok";

}

/*convierte los resultados a formato json*/

$resultadosJson = json_encode($resultados);



/*muestra el resultado en un formato que no da problemas de seguridad en browsers */

echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';




?>