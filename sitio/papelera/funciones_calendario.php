<?php

function construye_fecha($cuenta,$mes)
{
	if ($cuenta<10) 
	{ 
		$dia='0'.$cuenta;
	}
	else
	{
		$dia=$cuenta;
	}
 
     switch($mes) 
     { 
          case "enero": $mes='01';  break; 
          case "febrero": $mes='02';  break; 
          case "marzo": $mes='03';  break; 
          case "abril": $mes='04';  break; 
          case "mayo": $mes='05';  break; 
          case "junio": $mes='06';  break; 
          case "julio": $mes='07';  break; 
          case "agosto": $mes='08';  break; 
          case "septiembre": $mes='09';  break; 
          case "octubre": $mes='10';  break; 
		  case "noviembre": $mes='11';  break; 
          case "diciembre": $mes='12';  break; 
     } 
	
	$fecha=$dia.'/'.$mes.'/'.'2014';


return $fecha;
}


function comprueba_evento($cuenta,$mes,$eventos)
{
	$fecha=construye_fecha($cuenta,$mes);
	
	$existe=false;
	foreach ($eventos as $actual)
	{
		if ($fecha==$actual)
		{
			$existe=true;
		}
	}
	return $existe;
}

function marca_dia($cuenta)
{
	echo '<td id="dia_marcado_calendario">'.$cuenta.'</td>';
}

function dibuja_calendario($eventos,$mes)
{
$dias_de_mes=array("enero"=>31,"febrero"=>28,"marzo"=>31,"abril"=>30,"mayo"=>31,"junio"=>30,	"julio"=>31,"agosto"=>31,"septiembre"=>30,"octubre"=>31,"noviembre"=>30,"diciembre"=>31);
									
$primer_dia_mes=array(	"enero"=>'miercoles',	"febrero"=>'sabado',	"marzo"=>'sabado',	"abril"=>'martes',	"mayo"=>'jueves',	"junio"=>'domingo',	"julio"=>'martes',	"agosto"=>'viernes',	"septiembre"=>'lunes',	"octubre"=>'miercoles',	"noviembre"=>'sabado',	"diciembre"=>'lunes');							
							
$dias_en_blanco=array("enero"=>2,"febrero"=>5,"marzo"=>5,"abril"=>1,"mayo"=>3,	"junio"=>6,"julio"=>1,"agosto"=>4,"septiembre"=>0, "octubre"=>2,"noviembre"=>5,"diciembre"=>0);							


	echo '<table id="tabla_calendario">';
	echo '<th>L</th> <th>M</th> <th>M</th> <th>J</th> <th>V</th> <th>S</th> <th>D</th>';
	///////////////////////////////////////////////////
	echo '<tr align="center">';
	for ($blanco=1; $blanco<=($dias_en_blanco[$mes]); $blanco++)
	{
		echo '<td>'.' '.'</td>';
		
	}
	$inicio=$dias_en_blanco[$mes];
	$fin=$dias_en_blanco[$mes];
	for ($dia=$inicio; $dia<$fin; $dia++)
	{	
			echo '<td>'.' '.'</td>';
	}	
	$cuenta=1;
	for ($dia=$fin+1; $dia<=7; $dia++)
	{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}
		$cuenta++;
	}
	echo '</tr>';
	////////////////////////////////////////////////////
	echo '<tr align="center">';
	for ($dia=1; $dia<=7; $dia++)
	{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}		
		$cuenta++;
	}
	echo '</tr>';
    ///////////////////////////////////////////////////	
	echo '<tr align="center">';
	for ($dia=1; $dia<=7; $dia++)
	{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}		
		$cuenta++;
	}
	echo '</tr>';
    ///////////////////////////////////////////////////
	echo '<tr align="center">';
	for ($dia=1; $dia<=7; $dia++)
	{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}		
		$cuenta++;
	}
	echo '</tr>';
    ///////////////////////////////////////////////////
	echo '<tr align="center">';
	for ($dia=1; $dia<=7; $dia++)
	{
		if ($cuenta<=$dias_de_mes[$mes])
		{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}			
		$cuenta++;
		}
		else
		{
			echo '<td>'.' '.'</td>';
		}
	}
	echo '</tr>';
    ///////////////////////////////////////////////////			
	echo '<tr align="center">';
	for ($dia=1; $dia<=7; $dia++)
	{
		if ($cuenta<=$dias_de_mes[$mes])
		{
		if (comprueba_evento($cuenta,$mes,$eventos))
		{
			marca_dia($cuenta);			
		}
		else
		{
			echo '<td>'.$cuenta.'</td>';
		}			
		$cuenta++;
		}
		else
		{
			echo '<td style="border:0px">'.' '.'</td>';
		}
	}
	echo '</tr>';
    ///////////////////////////////////////////////////		
	echo '</table>';
	echo '<br />';
}

?>