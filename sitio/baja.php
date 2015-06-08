<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

echo '<h3  align="left">Baja del sistema </h3>';
$email = $_SESSION['EMAIL'];
$con = conectar_base_datos();
$rs = mysqli_query($con, "SELECT COMUNES FROM usuarios WHERE EMAIL='$email'");
$usr = mysqli_fetch_array($rs);
$saldo = $usr['COMUNES'];

if ($saldo == 0){
		mysqli_query($con, "DELETE FROM usuarios WHERE EMAIL='$email'");

		echo '<h3>Tus datos han sido borrados correctamente del sistema.</h3>';
		echo '<br>';	
		echo 'Gracias por haber confiado en nosotros. Y recuerda que puedes volver a registrarte cuando quieras.';
		echo '<br>';	
		echo '<a class="button" href="../index.php">Pulsa aqu&iacute; para volver a la p&aacute;gina de inicio</a>';
		echo '<br>';
		mysqli_close($con);
		session_unset(); // eliminar las variables de sesión
		session_destroy(); 
	}
else {
	 echo '<p align="left"> Tu saldo es distinto de cero. Para evitar el desequilibrio en la contabilidad del sistema, en caso de que tu saldo sea positivo, la opción más interesante es que realices una transferencia a favor del usuario Fondo Comunitario, ya que de esa forma beneficiarás a la comunidad en su conjunto. Si por el contrario es negativo, por favor, ponte en contacto con la administración a través de dinamizacion@malagacomun.org y te ayudaremos a resolver la situación lo antes posible. Gracias por tu comprensión. </p>';
	}
?>