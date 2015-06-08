<?php include ("cabecera_index.php"); ?>

<h3  align="left">Baja del sistema </h3>

<form action="borrar_usuario.php" method="POST" accept-charset="UTF-8"> 


<p> Si tu saldo es distinto de cero, por favor, ponte en contacto con la administración a través de dinamizacion@malagacomun.org para así evitar posibles desequilibrios en la contabilidad del sistema. Por favor, indícanos tu nombre de usuario y contraseña.<br />(Recuerda que se distingue entre letras mayúsculas y minúsculas).</p>

Usuario:<br />
<input  type="text" name="ALIAS" size="40" maxlength="200">

Contraseña: <br />
<input  type="password" name="CLAVE" size="40" maxlength="200">


<div class="row">
<div class="12u">
        <button type="submit" class="button">Anular mi suscripción y eliminar mis datos de Málaga Común</button>
</div>
</div>

</form>
</center>  











<!-- **********************fin del contenido del div contenido******************** -->
<?php
include ("pie_index.php");
?>