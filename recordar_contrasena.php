<?php include ("cabecera_index.php"); ?>

	<h3 class="texto_sombreado"> ¿Has olvidado tus datos de acceso? </h3>
	<p> Si has perdido o no recuerdas  tu nombre de usuario o la contraseña, escribe tu email debajo para enviartelos de nuevo.  </p>
  
	<form action="enviar_datos.php" method="POST" accept-charset="UTF-8">
		Email<br/>
		<input  type="text" name="email" value="" size="75%" maxlength="200" />	  
		<div class="row">
			<div class="12u">
					<button type="submit" class="button">Enviarme de nuevo los datos</button>
			</div>
		</div>  
    </form>
    
<?php include ("pie_index.php"); ?>