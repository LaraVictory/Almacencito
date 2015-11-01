<?php
$conexion = mysqli_connect("localhost", "webproye_npotasc", "kpwi792q", "webproye_ejemplo");
	
/* Extrae los valores enviados desde la aplicacion movil */


/* revisar existencia del usuario con la contraseña en la bd */
$sqlCmd = "SELECT idTrabajo, descripcion, tituloTrabajo FROM trabajos WHERE idUsuario =1";

$sqlQry = mysqli_query($conexion,$sqlCmd);



if(mysqli_num_rows($sqlQry)>0)
{
$login=1;

$fila=mysqli_fetch_array($sqlQry);


}
else
{
$login=0;
}

/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */

/* Extrae los valores enviados desde la aplicacion movil */
//$usuarioEnviado = $_GET['usuario'];
//$passwordEnviado = $_GET['password'];



/* verifica que el usuario y password concuerden correctamente */
if( $login==1 ){
/*esta informacion se envia solo si la validacion es correcta */
$resultados["validacion"] = "ok";

$resultados["idTrabajo"] =$fila["idTrabajo"];
$resultados["tituloTrabajo"] =$fila["tituloTrabajo"];
$resultados["descripcion"] =$fila["descripcion"];





}else{
/*esta informacion se envia si la validacion falla */
$resultados["mensaje"] = "Usuario y password incorrectos";
$resultados["validacion"] = "error";
}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>