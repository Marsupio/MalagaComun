<?php
//				*** Viene de mostrar_usuario.php ***
listar_anuncios_usuario ('demandas', $nombre, $email);
echo '<p style="clear:both">';
listar_anuncios_usuario ('ofertas', $nombre, $email);
echo '</p>';
include ("pie.php");

function listar_anuncios_usuario ($tipo_anuncios, $nombre, $email)
{
	$con = conectar_base_datos();
	$qry = "SELECT * FROM $tipo_anuncios WHERE (EMAIL='$email') ORDER BY ID DESC"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $qry); 
	$anuncio = mysqli_fetch_array($rs);
	if ($anuncio)
	{	
		if ($tipo_anuncios=='demandas') echo '<h2 align="left">'.$nombre.' necesita: </h2>';
		else echo '<h2 align="left">'.$nombre.' ofrece: </h2>';
		while($anuncio)
		{   
			$anuncio['NOMBRE'] = $nombre;
			muestra_anuncio_con_foto($anuncio);
			$anuncio = mysqli_fetch_array($rs);
		}
	}
	else echo '<p >Este usuario no ha publicado '.$tipo_anuncios.' o ya han caducado.</p>';
	mysqli_free_result($rs);
	mysqli_close($con);
}
?>
<script type= text/javascript>
$(function () {
	$('.cuerpo_anuncio').hide();
    $('.mostrar').click(function () {
	var index = $('.mostrar').index(this), newTarget = $('.cuerpo_anuncio').eq(index);
        newTarget.slideToggle('fast');
    })
});
</script>