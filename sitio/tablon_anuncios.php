<?php
include ("cabecera_inicio.php");
include ("autocompletar_ofertas.php");
?>
<!-- **************************contenido del div contenido******************** -->
<h3>Ver últimas:</h3>
<div id="tablon">
	<ul>
			<li><a href="ver_anuncios.php?tipo_anuncio=ofertas">[ Ofertas ]&emsp;</a></li>
			<li><a href="ver_anuncios.php?tipo_anuncio=demandas">[ Demandas ]</a></li>
	</ul>
</div>

<h4 align="left" style="font-size:1.5em"><b>Buscar oferta</b></h4>
<form action="mostrar_oferta.php" method="post"> 
		<input id="autocomplete-custom-append" name="seleccion" type="text" required/>
		<div id="suggestions-container" style="position: relative; float: left; width: 400px; margin: 0px;"></div>
		<button class="button"  type="submit" name="buscador">Ver oferta</button>Si existe lo que buscas, debe aparecer a medida que lo escribes
</form>
<br>
<div id="tablon">
	<ul><li><a href="publicar_anuncio.php"><i class="fa fa-file-o"></i>&emsp;Publicar oferta o demanda</a></li></ul>
</div>
<div id="tablon">
	<ul><li><a href="mis_anuncios.php"><i class="fa fa-pencil"> </i>&emsp;Editar / Renovar / Borrar tus anuncios</a></li></ul>
</div>
<p align="justify">Es importante que mantengas actualizados tus anuncios, para que la persona que contacte contigo tenga ciertas garantías de que va a ser atendida. Antes de dejar alguna petición sin respuesta, por favor, elimina las ofertas que no deseas seguir atendiendo. En caso de que trates de contactar con algún usuario a través de un anuncio publicado y no recibas respuesta, por favor comunícalo al <a href="mailto:administrador@malagacomun.org">administrador de Málaga Común</a>. Gracias por tu colaboración.</p>

<?php
include ("pie.php");
?>

