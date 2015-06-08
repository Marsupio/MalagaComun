<?php include ("cabecera_index.php");  ?>

<div style="float:left; padding-right:100px">

	<form action="control.php" method="POST" accept-charset="UTF-8"> 

			<?php
			if ($_GET["errorusuario"]=="si")
			{
				echo '<span  style="color:#ff0000;">Datos incorrectos. Por favor vuelve a intentarlo.<br></span>';
			}
			?>	
			Usuario:<br/>
			<input  type="text" name="ALIAS"  maxlength="200" required>
			Contraseña:<br />
			<input  type="password" name="CLAVE" maxlength="200" required>

			<div class="row">
			<div class="12u">
					<button type="submit" class="button">Iniciar Sesión</button><br><br>
					<a href="recordar_contrasena.php">Olvidé mi contraseña</a>
			</div>
			</div>
	</form>
</div>
<div>
	<h3 align="left">¿Aún no estás registrad@?</h3>
	<div align="left">
		<a href="registro.php">Ir a formulario de Registro</a>
	</div>
</div>

<?php include ("pie_index.php"); ?>