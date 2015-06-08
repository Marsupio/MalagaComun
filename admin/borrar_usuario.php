<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con=conectar_base_datos();

$id=$_GET["id"];

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE ID=$id"; 
//Ejecuto la sentencia 
$rs = mysqli_query($con, $ssql); 

$usuario = mysqli_fetch_array($rs);
$email = $usuario['EMAIL'];
$saldo = $usuario['COMUNES'];

if ($saldo == 0){
	if (mysqli_num_rows($rs)!=0){ 
		mysqli_query($con, "DELETE FROM  usuarios WHERE ID=$id");  //sus anuncios se borran en cascada (ON DELETE CASCADE)
		echo '<h3>Los datos e información de ese usuario han sido borrados correctamente del sistema.</h3>';	
		echo '<a class="button" href="pagina_administrador.php">Pulsa aquí para volver a la página de inicio</a>';
		//else echo 'Ha habido un error en la operación de borrado';
		}
	else{ 
		//si no existe le mando otra vez a la portada 
		echo 'No existe ese usuario en el sistema';
		echo '<br>';	
		echo '<a class="button" href="buscar_usuario_admin.php">Pulsa aquí para volver a intentarlo</a>';
		echo '<br>';	
		}
	}
else {
	 echo 'Su saldo es distinto de cero. Por favor, ponte en contacto con el usuario para resolver el problema.';
}

mysqli_close($con);
?>