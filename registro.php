<?php
include ("cabecera_index.php");
include 'sitio/conectar_bd.php';
include("captcha/simple-php-captcha.php");

session_start();
?>

<h3>Registro como nuevo participante</h3>

<p align="justify" ><b>Participar en Málaga Común implica una serie de compromisos a cumplir. El nivel de actividad que desees tener lo marcas tú, pero una vez ofrezcas algo públicamente en la red debes comprometerte a atender las peticiones que te lleguen a través de la web de Málaga Común. En el momento que quieras dejar de atender peticiones simplemente puedes borrar tus anuncios correspondientes, inactivar tu cuenta o darte de baja.</b>

<p align="justify" ><b>También existe un compromiso con la comunidad. El proyecto de Málaga Común se sostiene en base al trabajo de los miembros más activos que realizan tareas de difusión, organización de mercadillos, gestión de lugares físicos de encuentros periódicos, mejoras del sistema informático, asambleas, etc. Siendo conscientes de que no todo el mundo dispone del tiempo necesario para colaborar en dichas tareas comunitarias, se establece un sistema de cuotas mensuales en moneda social para todos los miembros activos que irá cambiando en función del número de usuarios activos y las necesidades a cubrir. También existe la posibilidad de desactivar tu cuenta en caso de que vayas a pasar un tiempo durante el que no puedas o quieras participar en Málaga Común, pudiendo volver a activarla cuando desees.</b>

 <p align="justify" ><b>Ten en cuenta además que Málaga Común es un proyecto de gestión ciudadana que no recibe ayudas públicas y que se construye con el trabajo de gente que tiene fe en crear formas diferentes de relacionarnos y sostener nuestras vidas, tratando de escapar de una precariedad que nos impide desarrollarnos a muchos niveles. Pero conseguirlo no es fácil y se necesita mucha colaboración, apoyo y paciencia. Si tod@s tratamos de aportar parte de nuestra energía y nuestro tiempo, tendremos muchas más posibilidades de tener éxito. Si te sientes motivad@ a participar de esta aventura colectiva rellena el formulario a continuación y no dudes en contactar con nosotr@s en cualquier momento. Disponemos de un grupo de acogida que estará encantado de ayudarte a dar tus primeros pasos (acogida (arroba) malagacomun.org)</b>

<p align="justify" ><b>Los datos que introduzcas a continuación serán visibles sólo por los demás usuarios de la red. <br>
Son imprescindibles tu nombre, apellidos, localidad, código postal y dirección de correo electrónico, que se usará para enviarte mensajes y notificaciones, así como tu nombre de usuario y contraseña, necesarios para poder iniciar sesión en la web. No obstante es recomendable que indiques tu teléfono para facilitar a los demás usuarios el contacto contigo </b>
</p>

<form method="post" action="insertar_usuario.php" accept-charset="UTF-8">

Nombre * 
<input  type="text" name="nombre" value="" size="55%" maxlength="50" required /><br />
Apellidos *
<input  type="text" name="apellidos" value="" size="55%" maxlength="100" required /><br />
Teléfono
<input  type="text" name="telefono" value="" size="55%" maxlength="15" /><br />
Localidad *
<?php 	include ('sitio/comarcas.php'); ?> <br />
Código Postal *
<input  type="number" name="cp" value="" size="55%" required /><br />
Email *
<input  type="email" name="email" value="" size="55%" maxlength="50" required /><br />
Nombre de Usuario *
<input  type="text" name="alias" value="" size="55%" maxlength="30" required /><br />
Contraseña *
<input  type="text" name="clave" value="" size="55%" maxlength="20" required /><br><br><br>

<h3>Ahora debes ofrecer un servicio a la red para poder darte de alta. Luego podrás modificarlo en cualquier momento</h3>
(Por favor, rellena a continuación los detalles de tu oferta) <br><br>

Título *
<br />
<input name="titulo" type="text" size="80%" maxlength="50" required />
<br />
Etiquetas (opcional) <b>--- añade palabras clave para facilitar la búsqueda de tu anuncio</b>
<br />
<input name="etiquetas" type="text" size="80%" />
<br />
Descripción *
<br />
<textarea  name="cuerpo" size="80%" cols="42%" rows="4" required /></textarea>
<br />
Verificación *
<br>
<?php
$_SESSION['captcha'] = simple_php_captcha();
echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />';
?>
<input name="captcha" type="text" size="10%" maxlength="10" required />

<div  class="row">
<div class="12u">
<p align="justify">De acuerdo con lo establecido con la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, el usuario de este sitio web podrá, en todo momento, ejercitar los derechos de acceso, rectificación y cancelación de sus datos personales. Para ello, podrá modificar sus datos desde el menú de usuario, y tendrá total libertad de eliminar toda su información personal aquí almacenada, así como todos sus anuncios en cualquier momento si así lo desea. <br>

        <button type="submit" class="button">Registrarse</button>
</p>	
</div>
</div>

</form>

<?php include ("pie_index.php"); ?>