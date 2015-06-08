<?php

$array_coordenadas=array();

$file = fopen ("marcas.txt", "r");

$linea = fgets($file);
while (!feof($file) ) 
{
		$linea = fgets($file);

		array_push($array_coordenadas, $linea);

}

fclose ($file);


foreach ($array_coordenadas as $valor)
{

	$cp=substr($valor,0,5);
	echo $cp;
	echo '<br>';	
	
	$latitud=substr($valor,6,10);
	echo $latitud;
	echo '<br>';	
	
	$longitud=substr($valor,17,10);
	echo $longitud;
	echo '<br>';	

	echo '<br>';	
	echo '<br>';	
	
}


?>