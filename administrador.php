<?php include ("cabecera_index.php"); ?>
 
<h3 align="left" >Bienvenid@ a la administración y gestión del sistema.</h3>

<form action="control_admin.php" method="POST" accept-charset="UTF-8"> 

<?php
if ($_GET["errorusuario"]=="si")
{
	echo '<p style="color:#ff0000">Datos incorrectos. Por favor vuelva a intentarlo.</p>';
}
else
{
	echo '<p style="color:#000000">Indique su nombre de usuario y contraseña</p>';
}
?>



Administrador:<br />
<input id="formulario" type="text" name="ALIAS" size="40" maxlength="200">


Contraseña:<br />
<input id="formulario" type="password" name="CLAVE" size="40" maxlength="200">


<div class="row">
<div class="12u">
        <button type="submit" class="button">Entrar como administrador</button>
</div>
</div>



</form>
</center>

<!-- **********************fin del contenido del div contenido******************** -->
<?php
include ("pie_index.php");
?>