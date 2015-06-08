<?php include ("cabecera_index.php");  ?>

<h3 align="left" >Inicio de Sesión</h3>

<form action="control.php" method="POST" accept-charset="UTF-8"> 

<?php
if ($_GET["errorusuario"]=="si")
{
	echo '<span  style="color:#ff0000;">Datos incorrectos. Por favor vuelve a intentarlo.</span>';
}
else
{
	echo '<span style="color:#000000;">Indica tu nombre de usuario y contraseña</span>';
}
?>
<br />
<br/>

Usuario:<br/>
<input  type="text" name="ALIAS"  maxlength="200">
Contraseña:<br />
<input  type="password" name="CLAVE" maxlength="200">

<div class="row">
<div class="12u">
        <button type="submit" class="button">Entrar a Málaga Común</button>
		<a class="button" href="menu3.php">Olvidé mi contraseña</a>
</div>
</div>
</form>

<p align="left">
<h3>¿Aún no estás registrad@?</h3>
<a class="button" href="menu2.php">Ir a formulario de Registro</a>
</p>




<?php include ("pie_index.php"); ?>