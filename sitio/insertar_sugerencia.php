<?php
include ("funciones.php");
include ("cabecera_inicio.php");


if (!$_POST)
{
?>
<div align="left">
<h2>Ayúdanos a mejorar!</h2> 
escribe tus sugerencias o avísanos si encuentras algún error<br><br>
</div>
<form  action="insertar_sugerencia.php" method="POST" lang="es" >
		Asunto:<input type="text" name="asunto" maxlength="100" required></input>
		Descripción:<textarea id="formulario2" name="texto" type="text"   rows="9" required /> </textarea>
		<button class="button" type="submit">Publicar Sugerencia</button>	
</form>

<?php
}
?>

<?php

if ($_POST)
{
$asunto=$_POST['asunto'];
$texto=$_POST['texto'];
$fecha=obten_fecha();
$autor=$_SESSION['NOMBRE'];
$email=$_SESSION['EMAIL'];

	if (strlen($texto)>5 && $texto!='')
	{
		$con=conectar_base_datos();
		mysqli_query($con, "insert into sugerencias (ASUNTO,TEXTO,FECHA,AUTOR,EMAIL) values ('$asunto','$texto','$fecha','$autor','$email')");
		mysqli_close($con);	
		echo'<h2>Gracias por aportar sugerencias para este sitio mejore.</h2>';
		echo'<p>Estudiaremos su sugerencia e intentaremos incluirla en la web si es posible.</p>';
		
	}
	else
	{
		echo'<h2>Por favor escriba algo antes de enviar su sugerencia</h2>';
		echo "<a class='button' href='insertar_sugerencia.php'>Volver a intentarlo</a>";
		
	}

}

include ("pie.php");
?>