<?php

//include ("seguridad.php");
include ("sitio/config_local.php");
include ("cabecera_index.php");
include ("sitio/funcs_sitio.php");

$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$telefono=$_POST["telefono"];
$localizacion=$_POST["localizacion"];
$cp=$_POST["cp"];
$email=$_POST["email"];
$alias=$_POST["alias"];
$clave=$_POST["clave"];
$comunes=0;
$captcha=$_POST["captcha"];

$titulo=$_POST["titulo"];
$cuerpo=$_POST["cuerpo"];
$etiquetas=$_POST["etiquetas"];
$fecha=obten_fecha();

if ($nombre!='' && $apellidos!='' && $email!='' && $alias!='' && $clave!='' && $captcha!='') //evitar registro fraudulento
{
session_start();
	
	// primero compruebo que ese email no este ya en uso
	$existe = existe_email($email);
		if ($existe)  //el email ya esta en uso y no se puede registrar
			{
			echo '<h3>El correo electrónico que estás usando para registrarte ya está en uso.</h3>';
			echo '<p>Por favor, revisa que es tu correo. <br>Gracias.</p>';
			echo '<a href="www.malagacomun.org" onclick="history.go(-1); return false;"> VOLVER </a>';
			}
		elseif ($captcha != $_SESSION['captcha']['code'])  //el código captcha es incorrecto
			{
			echo '<center>';
			echo '<p><b>El código captcha introducido es incorrecto</b><p>';
			echo '<a href="www.malagacomun.org" onclick="history.go(-1); return false;"> VOLVER </a>';
			echo '</center>';
			}
		else  //si todo es correcto
			{
			// inserto el usuario //
			$cnx=conectar_base_datos();
			mysqli_query($cnx, "INSERT INTO usuarios (NOMBRE, APELLIDOS, TELEFONO, EMAIL, ALIAS, CLAVE, COMUNES, LOCALIZACION, CP) VALUES ('$nombre', '$apellidos', '$telefono', '$email', '$alias', '$clave', '$comunes', '$localizacion', '$cp')");

			// inserto la oferta
			mysqli_query($cnx, "INSERT INTO ofertas (TITULO,CUERPO,ETIQUETAS,EMAIL,FECHA,LOCALIZACION) VALUES ('$titulo','$cuerpo','$etiquetas','$email','$fecha', '$localizacion')");
			
			mysqli_close($cnx);
			///////////mando el email de bienvenida al usuario/////////
			$nombre_admin='Administrador';

			$cabeceras = "MIME-Version: 1.0"."\r\n";
			$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
			$cabeceras .= "From: ".$nombre_admin."<".$email_admin.">"."\r\n";

			$mensaje = "<h3>Bienvenid@ a Málaga Común.</h3>";
			$mensaje .= "<p>Esperamos que te resulte interesante esta iniciativa y la labor social que lleva a cabo Málaga Común</p>";
			$mensaje .= "<p>Tus datos de acceso son: <br>Nombre de usuario: <b>".$alias."</b><br>Contraseña: <b>".$clave."</b></p>";
			$mensaje .= "<p>Guarda en lugar seguro tus datos de acceso y recuerda que ya puedes iniciar sesión desde este mismo momento.</p>";
			$mensaje .= "<p>Saludos</p>";


			$mensaje .= "<p>Enviado el " . date('d/m/Y', time())."</p>";

			$para = $email;
			$asunto = 'Malaga Comun';

			mail($para, $asunto, $mensaje, $cabeceras);

			///////// mando el email de aviso de nuevo registro al admin//////////

			$nombre_usuario='Nuevo Usuario';
			$email_usuario=$email;

			$cabeceras = "MIME-Version: 1.0"."\r\n";
			$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
			$cabeceras .= "From: ".$nombre_usuario."<".$email_usuario.">"."\r\n";

			$mensaje = "<h3>Se ha registrado un nuevo usuario en la web de Málaga Común</h3>";
			$mensaje .= "<p>Estos son los datos que el usuario ha proporcionado:</p>";
			$mensaje .= "<p>Por favor, comprueba que todo esté correcto: </p>";

			$mensaje.='Nombre: '.$nombre.'<br>';
			$mensaje.='Apellidos: '.$apellidos.'<br>';
			$mensaje.='Teléfono: '.$telefono.'<br>';
			$mensaje.='Localidad: '.$localizacion.'<br>';
			$mensaje.='Código Postal: '.$cp.'<br>';
			$mensaje.='Email: '.$email.'<br><br>';
			$mensaje.='Título de la oferta: '.$titulo.'<br>';
			$mensaje.='Descripción: '.$cuerpo.'<br>';
			$mensaje.='Registrado el: '.$fecha.'<br><br>';
			$mensaje.='<p>Por defecto el usuario ya se encuentra registrado en la web. Es tarea del admistrador comprobar estos datos. En caso de que detectes alguna irregularidad en los datos personales o en la oferta publicada, ponte en contacto con el usuario.</p>';

			$mensaje .= "<p>Enviado el " . date('d/m/Y', time())."</p>";

			$para = $email_admin;
			$asunto = 'Nuevo registro de usuario en Malaga Comun';

			mail($para, $asunto, $mensaje, $cabeceras);
				
			////////////indico al usuario que todo correcto	///////////////////

			echo '<p align="justify">Bienvenid@ a Málaga Común. Tu registro está aún pendiente de validación por el administrador.  De todas formas, ya puedes iniciar sesión en la web. Recuerda guardar en lugar seguro tu nombre de usuario y contraseña.</p>';

			echo '<p>Para que puedas integrarte en la red fácilmente te animamos a presentarte escribiendo al grupo de acogida de Málaga Común (acogida@malagacomun.org). Alguna persona de dicho grupo tratará de orientarte de acuerdo a tus inquietudes y preferencias, proporcionándote contactos e información práctica </p>'; 
			echo '<a class="button" href="index.php">Haz click aquí para continuar</a>';
			}
}
/*****************************************/
include ("pie_index.php");
?>

