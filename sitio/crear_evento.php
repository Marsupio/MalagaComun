<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
?>


<h2>Creación de un evento e inclusión en el calendario público.</h2>

<form action="insertar_evento.php" method="POST" accept-charset="UTF-8">

<br />
Evento <br />
<input   type="text" name="evento" size="100%" maxlength="200" /></td>

<br />
Lugar<br />
<input  type="text" name="lugar" size="100%" maxlength="200" /></td>

<br />
Fecha<br />
<input  type="date" name="fecha"></td>

<br />
Hora inicio<br />
<input  type="time" name="hora"></td>

<br />
Notas<br />
<textarea type="text" name="notas" rows='5'/> </textarea>

<br />
<input class="button"  type="submit" value="Crear este evento" />

</form>

<?php include ("pie.php"); ?>