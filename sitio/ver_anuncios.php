<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

	$tipo_anuncio = $_GET['tipo_anuncio'];
	if ($tipo_anuncio == 'ofertas') echo '<a href="ver_anuncios.php?tipo_anuncio=demandas">[ Ver Demandas ]</a>';
	else echo '<a href="ver_anuncios.php?tipo_anuncio=ofertas">[ Ver Ofertas ]</a>';

	$con=conectar_base_datos();
	$rs = mysqli_query($con, "SELECT $tipo_anuncio.*, usuarios.NOMBRE FROM $tipo_anuncio JOIN usuarios ON $tipo_anuncio.EMAIL=usuarios.EMAIL ORDER by $tipo_anuncio.ID desc limit 40");	

	echo '<h3 align="left">Últimas '.$tipo_anuncio.' publicadas</h3>';
	echo '<h5 align="left">Clica en el anuncio para ver los detalles</h5><br>';
	$i=1;
	while($anuncio = mysqli_fetch_array($rs))
	{		
		muestra_anuncio_con_foto($anuncio);
	}
	mysqli_close($con);

/**************************************************************************************/
include ("pie.php");
?>
<script type= text/javascript>
$(function () {
	$('.cuerpo_anuncio').hide();
    $('.mostrar').click(function () {
	var index = $('.mostrar').index(this), newTarget = $('.cuerpo_anuncio').eq(index);
        newTarget.slideToggle();
    })
});
</script>