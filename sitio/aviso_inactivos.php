<?php include "cabecera_inicio_aviso_inactivos.php"; ?>
<i style="color:purple" class="fa fa-info-circle"> </i>
<h3 style="color:purple">Nota informativa</h3><br>

<p align="left">Se ha incorporado un sistema de activación/desactivación de cuentas gestionado por los propios usuarios, con el fin de aclarar qué usuarios tienen interés en participar (estando informados de las actividades que se organizan), y cuáles no, aunque sea de manera provisional.</p>

 <p align="left">Por defecto todas las cuentas estarán en modo 'inactiva', y tendrá que ser el propio usuario el que cambie su cuenta a modo 'activa'. En caso de que no lleve a cabo este cambio en un plazo de 4 semanas (contando desde el 1 de Mayo), su cuenta pasará a estar realmente inactiva y el usuario dejará de recibir la mayoría de las notificaciones que se envían a través del correo electrónico, y su perfil y sus anuncios se harán 'invisibles' para el resto de usuarios mientras no active su cuenta. En cualquier momento que lo desee, el usuario podrá activar su cuenta y volver a participar, ya que la desactivación no implica la baja ni la alteración del saldo del usuario.</p>
 
 <div id="tablon">
	<ul>
			<li><a href='activacion_cuenta.php?activar=si'>Activar cuenta &emsp;&emsp;</a></li>
			<li><a href="fin_sesion.php">Activar en otro momento &emsp;&emsp;</a></li>
			<li><a href='baja.php'>Darme de baja del sistema</a></li>
	</ul>
</div>
 
<?php include "pie.php"; ?>