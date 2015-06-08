<?php
include ("funciones.php");
include ("cabecera_calendario.php");

?>

<?php 
/*************************************************************************************/
function muestra_evento()
{
?>
<div class="events">
<ul>
							
<li>
        <span class="title">Reunión</span>
        <span class="desc">Asamblea en la invisible a las 19:00 h.</span>
</li>

</ul>
</div>					
	
	
<?php
}
/************************************************************************************/
function comprueba_dia_evento($dia, $eventos)
{
	$es_dia_evento=false;
	
	foreach ($eventos as $valor) 
	{
    		if ($dia==$valor) { $es_dia_evento=true; }
	}
	
	return $es_dia_evento;
}

/*******************************************************************************************/

function dibuja_mes($mes, $ano, $blancos, $dias_del_mes,  $dia_actual, $mes_actual, $ano_actual,$eventos)
{

echo '<table id="tabla2"><thead><tr><th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>   </thead><tbody>';

 $resto_primera_semana=7-$blancos;
 $dia=1;
 $dias_restantes=$dias_del_mes;
  
/****** primera semana   *******************/ 
if ($blancos==0)
{
	
		echo '<tr>';
		for ($i=1; $i<=$resto_primera_semana; $i++)
		{
				$es_dia_evento = comprueba_dia_evento($dia, $eventos);
			
				if  (($dia==$dia_actual) and ($mes==$mes_actual) and ($ano==$ano_actual))
				{
						echo '<td class="today">'.$dia.'</td>';	
						$dia++;
				}
				elseif ($es_dia_evento)
				{

						echo '<td class="date_has_event">';
						
								echo $dia;
								//muestra_evento();
						
						echo '</td>';	
						$dia++;
				}				
				else
				{
						echo '<td>'.$dia.'</td>';	
						$dia++;					
				}
		}
		 echo '</tr>';	
	
}
elseif ($blancos>0)
{

		echo '<tr>';
		echo '<td class="padding" colspan="'.$blancos.'"></td>';
		for ($i=1; $i<=$resto_primera_semana; $i++)
		{
				$es_dia_evento = comprueba_dia_evento($dia, $eventos);
			
				if  (($dia==$dia_actual) and ($mes==$mes_actual) and ($ano==$ano_actual))
				{
						echo '<td class="today">'.$dia.'</td>';	
						$dia++;
				}
				elseif ($es_dia_evento)
				{
						echo '<td class="date_has_event">';
						
								echo $dia;
								//muestra_evento();
						
						echo '</td>';	
						$dia++;
				}				
				else
				{
						echo '<td>'.$dia.'</td>';	
						$dia++;					
				}
		}
		 echo '</tr>';

}
/********* segunda semana  en adelante*********/ 
while (($dia<=$dias_del_mes) and ($dias_restantes>0))
{

$dias_restantes=$dias_del_mes-$dia+1;

if ($dias_restantes>=7)
{

		echo '<tr>';
		 for ($i=1; $i<=7; $i++)
		{
				$es_dia_evento = comprueba_dia_evento($dia, $eventos);
			
				if  (($dia==$dia_actual) and ($mes==$mes_actual) and ($ano==$ano_actual))
				{
						echo '<td class="today">'.$dia.'</td>';	
						$dia++;
				}
				elseif ($es_dia_evento)
				{
						echo '<td class="date_has_event">';
						
								echo $dia;
								//muestra_evento();
						
						echo '</td>';	
						$dia++;
				}				
				else
				{
						echo '<td>'.$dia.'</td>';	
						$dia++;					
				}
		}
		echo '</tr>'; 

}

if ($dias_restantes<7)
{
	

		echo '<tr>';
		 for ($j=1; $j<=$dias_restantes; $j++)
		{
				$es_dia_evento = comprueba_dia_evento($dia, $eventos);
			
				if  (($dia==$dia_actual) and ($mes==$mes_actual) and ($ano==$ano_actual))
				{
						echo '<td class="today">'.$dia.'</td>';	
						$dia++;
				}
				elseif ($es_dia_evento)
				{
						echo '<td class="date_has_event">';
						
								echo $dia;
								//muestra_evento();
						
						echo '</td>';	
						$dia++;
				}				
				else
				{
						echo '<td>'.$dia.'</td>';	
						$dia++;					
				}
		}


		$blancos_del_final=7-$dias_restantes;
		echo '<td class="padding" colspan="'.$blancos_del_final.'"></td>';
		
		echo '</tr>'; 	
	
}


}
echo '</tbody><tfoot></tfoot></table>';
}
/************************************************************************************/
echo '<h2>Calendario anual para el 2014 de eventos programados</h2>';

$fecha = date('d/m/Y', time());
$dia_actual = date("j");
$mes_actual = date("n");
$ano_actual = date("Y");

$eventos=array (2,25);

dibuja_mes(1, 2014, 2, 31,  $dia_actual, $mes_actual, $ano_actual, $eventos);




?>             

        






















<?php
/************************************************************************************************/
$conexion=conectar_base_datos();

// muestro el calendario
$rs1 = mysql_query("SELECT * FROM eventos",$conexion); 


$eventos=array();
$i=0;
while($fila = mysql_fetch_array($rs1))
{
	$eventos[$i]=$fila['FECHA'];
	$i++;
}




// Muestro las eventos
echo '<h2>Listado de eventos programados.</h2><br/>';      

	
//Sentencia SQL para buscar los eventos
$ssql2 = "SELECT * FROM eventos ORDER BY ID"; 

//Ejecuto la sentencia 
$rs2 = mysql_query($ssql2,$conexion); 


echo " <table   align='center'> 

<tr>

<th>Evento </th>
<th>Lugar</th>
<th>Fecha</th>
<th>Inicio</th>
<th>Fin</th>
<th>Notas</th>

</tr>";

$cantidad=0;
while($row2 = mysql_fetch_array($rs2))
  {
	  $id=$row2['ID'];
	  $evento=$row2['EVENTO']; 
	  $lugar=$row2['LUGAR']; 
	  $fecha=$row2['FECHA']; 
	  $inicio=$row2['INICIO']; 
	  $fin=$row2['FIN']; 
	  $notas=$row2['NOTAS'];
	    	  
  echo "<tr>";
  
  echo "<td>" . $evento . "</td>";
  echo "<td>" . $lugar . "</td>";
  echo "<td >" . $fecha . "</td>";
  echo "<td>" . $inicio . "</td>";
  echo "<td>" . $fin . "</td>";
  echo "<td width='50%' style='text-align:left; padding-left:25px'>" . nl2br($notas) . "</td>";

   
  echo "</tr>";
  $cantidad++;
  }
echo "</table>";

echo "<br>";
echo "<p align='center'>Total de Eventos: " . "<b> ".  $cantidad ."</b>". "</p>";

mysql_close($conexion);
include ("pie.php");
?>