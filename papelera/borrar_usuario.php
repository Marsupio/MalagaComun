<?php
include ("sitio/funciones.php");
include ("sitio/cabecera_inicio.php");

$con=conectar_base_datos();

$alias=$_POST["ALIAS"];
$clave=$_POST["CLAVE"];

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE ((ALIAS='$alias')&&(CLAVE='$clave'))"; 
//Ejecuto la sentencia 
$rs = mysql_query($ssql,$con); 

$usuario = mysql_fetch_array($rs);
$email = $usuario['EMAIL'];
$saldo = $usuario['COMUNES'];

if ($saldo == 0){
	if (mysql_num_rows($rs)!=0){ 
		//usuario y contraseña válidos,  lo borro
		mysql_query("DELETE FROM  usuarios WHERE ((CLAVE='$clave')&&(ALIAS='$alias'))");
	
		mysql_query("DELETE FROM ofertas WHERE (EMAIL='$email')");
		mysql_query("DELETE FROM demandas WHERE (EMAIL='$email')");


		echo '<h3>Sus datos e informaci&oacute;n han sido borrados correctamente del sistema.</h3>';
		echo '<br>';	
		echo 'Gracias por haber confiado en nosotros. Y recuerde que puede volver a apuntarse cuando quiera.';
		echo '<br>';	
		echo '<a class="button" href="index.php">Pulse aqu&iacute; para volver a la p&aacute;gina de inicio</a>';
		echo '<br>';	
		}
	else{ 
		//si no existe le mando otra vez a la portada 
		echo 'No existe ese usuario en el sistema';
		echo '<br>';	
		echo '<a class="button" href="menu5.php">Pulse aqu&iacute; para volver a la p&aacute;gina de inicio o volver a intentarlo</a>';
		echo '<br>';	
		}
	}
else {
	 echo 'Tu saldo es distinto de cero. Por favor, ponte en contacto con la administración a través de dinamizacion@malagacomun.org. Te ayudaremos a resolver la situación lo antes posible';
}

mysql_close($con);
?>