<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

$email = $_SESSION['EMAIL'];
$con=conectar_base_datos();

// Muestro las OFERTAS del usuario
echo '<h2>Mis Ofertas</h2>';      
	
//Sentencia SQL para buscar las ofertas publicadas por ese usuario 
$ssql2 = "SELECT * FROM ofertas WHERE EMAIL='$email' ORDER BY ID DESC"; 
//Ejecuto la sentencia 
$rs2 = mysqli_query ($con, $ssql2); 
$total=mysqli_num_rows($rs2);
echo '<p align="center">Has publicado un total de '.$total.' oferta(s)</p>';
$anuncio = mysqli_fetch_array($rs2);
while($anuncio)
  {
		$tipo_anuncio='ofertas'; 		// dato necesario para borrar anuncio
	
		muestra_anuncio_propio_con_foto($anuncio, $tipo_anuncio);
		$anuncio = mysqli_fetch_array($rs2);
  }


// Muestro las DEMANDAS de ese usuario
echo '<h2>Mis Demandas </h2>';      
	
//Sentencia SQL para buscar las demandas publicadas por ese usuario 
$ssql2 = "SELECT * FROM demandas WHERE EMAIL='$email' ORDER BY ID DESC"; 

//Ejecuto la sentencia 
$rs2 = mysqli_query($con, $ssql2); 

$total=mysqli_num_rows($rs2);
echo '<p align="center">Has publicado un total de '.$total.' demandas(s)</p>';
$anuncio = mysqli_fetch_array($rs2);
while($anuncio)
  {
	$tipo_anuncio='demandas'; 		// para borrar anuncio
	
	muestra_anuncio_propio_con_foto($anuncio, $tipo_anuncio);
	$anuncio = mysqli_fetch_array($rs2);
  }
    
mysqli_close($con);
include ("pie.php");
?>