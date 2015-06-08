<?php
include ("cabecera_index.php");
include ('sitio/funciones.php');
include("captcha/simple-php-captcha.php");
?>

<h3>Formulario de registro como nuevo usuario:</h3>

<p>Los datos que introduzcas serán visibles sólo por los demás usuarios de la red</p> 

<p align="justify" >
Los datos imprescindibles son tu nombre y dirección de correo electrónico, que se usará para enviarte mensajes y notificaciones, y tu nombre de usuario y contraseña, necesarios para poder iniciar sesión en la web. No obstante es recomendable que indiques tu teléfono y código postal para facilitar a los demás usuarios el contacto contigo
</p>
<!-- para el código captcha -->
<?php
session_start();
?>


<!-- ------------------------------------------------------------------------------------ -->

<form method="post" action="insertar_usuario.php" accept-charset="UTF-8">

Nombre *
<input  type="text" name="nombre" value="" size="55%" maxlength="200" required /><br />

Apellidos
<input  type="text" name="apellidos" value="" size="55%" maxlength="200" /><br />


Teléfono
<input  type="text" name="telefono" value="" size="55%" maxlength="200" /><br />


Localidad *
<?php 	include ('sitio/localidades.php'); ?>
<br />

Código Postal
<input  type="number" name="cp" value="" size="55%"  /><br />

Email *
<input  type="email" name="email" value="" size="55%" maxlength="200" required /><br />

Nombre de Usuario *
<input  type="text" name="alias" value="" size="55%" maxlength="200" required /><br />

Contraseña *
<input  type="text" name="clave" value="" size="55%" maxlength="200" required /><br />

<br />
<br />
<h3>Debes ofrecer un servicio a la comunidad para poder darte de alta. Luego podrás modificarlo en cualquier momento</h3>

(Por favor, rellena a continuación los detalles de tu oferta)

<br />
<br />

Título *
<br />
<input   name="titulo" type="text" size="55%" placeholder="Titulo que aparecerá en el tablón de anuncios." required /><br />


Descripción *
<br />
<textarea  name="cuerpo" cols="42%" rows="10" placeholder="Describe tu oferta indicando los detalles que consideres oportunos." required /></textarea>

<br />

Categoría *
<?php include ('sitio/categorias.php');?>
<br>

Código Captcha *
<br>
<?php
$_SESSION['captcha'] = simple_php_captcha();
echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />';
?>
<input name="captcha" type="text" size="10%" maxlength="10" required />

<div  class="row">
<div class="12u">
<p align="justify">De acuerdo con lo establecido con la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, el usuario de este sitio web podrá, en todo momento, ejercitar los derechos de acceso, rectificación y cancelación de sus datos personales. Para ello, podrá modificar sus datos desde el menú de usuario, y tendrá total libertad de eliminar toda su información personal aquí almacenada, así como todos sus anuncios en cualquier momento si así lo desea.</p>

        <button type="submit" class="button">Registrarse</button>
</div>
</div>



</form>  


<?php include ("pie_index.php"); ?>