<?php

include ('funciones.php');


$array_fichero=array();

$file = fopen ("marcas.txt", "r");
while (!feof($file) ) 
{
		$linea = fgets($file);
		array_push($array_fichero, $linea);
}
fclose ($file);


$array_asociativo = array ();
foreach ($array_fichero as $valor)
{
	$cp=substr($valor,0,5);
	$latitud=substr($valor,6,10);
	$longitud=substr($valor,17,10);

	$nuevo = array ('cp' => $cp, 'latitud' => $latitud, 'longitud' => $longitud);
	array_push($array_asociativo, $nuevo);
	
}


$codigos=codigos_postales();



$total=count($codigos);

$coords=array();
for ($i=0; $i<=$total-1; $i++)
{
		$cp=$codigos[$i];
		
		$coord=obten_coord_desde_array($array_asociativo, $cp);
		
		array_push($coords,$coord);	


}


?>