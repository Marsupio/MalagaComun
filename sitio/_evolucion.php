<?php
include ("cabecera_inicio.php");
include ("conectar_bd.php");


echo '<h2>Balance global a lo largo del tiempo</h2>';
echo '<p>En el eje horizontal se muestran los meses del año y en el eje vertical la cantidad de comunes que se han movido en ese mes.</p>';

$ano_2013= array('enero'=>0, 'febrero'=>0, 'marzo'=>0, 'abril'=>0,'mayo'=>0, 'junio'=>0, 'julio'=>0, 'agosto'=>0, 'septiembre'=>0, 'octubre'=>0, 'noviembre'=>0, 'diciembre'=>0,);
$ano_2014= array('enero'=>0, 'febrero'=>0, 'marzo'=>0, 'abril'=>0,'mayo'=>0, 'junio'=>0, 'julio'=>0, 'agosto'=>0, 'septiembre'=>0, 'octubre'=>0, 'noviembre'=>0, 'diciembre'=>0,);

$conexion=conectar_base_datos();
$result = mysql_query("SELECT CANTIDAD, FECHA FROM pagos");

while($row = mysql_fetch_array($result))
{	  
	$cantidad=$row['CANTIDAD'];
	$fecha=$row['FECHA'];
	
	$mes = substr($fecha, 3,2);
	$ano = substr($fecha, 6,4);
	
	
	if ($ano=='2013')
	{
		if ($mes=='01') 	{		$ano_2013['enero']=$ano_2013['enero'] + $cantidad;		}
		if ($mes=='02') 	{		$ano_2013['febrero']=$ano_2013['febrero'] + $cantidad;		}
		if ($mes=='03') 	{		$ano_2013['marzo']=$ano_2013['marzo'] + $cantidad;		}
		if ($mes=='04') 	{		$ano_2013['abril']=$ano_2013['abril'] + $cantidad;		}
		if ($mes=='05') 	{		$ano_2013['mayo']=$ano_2013['mayo'] + $cantidad;		}
		if ($mes=='06') 	{		$ano_2013['junio']=$ano_2013['junio'] + $cantidad;		}
		if ($mes=='07') 	{		$ano_2013['julio']=$ano_2013['julio'] + $cantidad;		}
		if ($mes=='08') 	{		$ano_2013['agosto']=$ano_2013['agosto'] + $cantidad;		}
		if ($mes=='09') 	{		$ano_2013['septiembre']=$ano_2013['septiembre'] + $cantidad;		}
		if ($mes=='10') 	{		$ano_2013['octubre']=$ano_2013['octubre'] + $cantidad;		}
		if ($mes=='11') 	{		$ano_2013['noviembre']=$ano_2013['noviembre'] + $cantidad;		}
		if ($mes=='12') 	{		$ano_2013['diciembre']=$ano_2013['diciembre'] + $cantidad;		}
		

	}
	elseif ($ano=='2014')
	{

		if ($mes=='01') 	{		$ano_2014['enero']=$ano_2014['enero'] + $cantidad;		}
		if ($mes=='02') 	{		$ano_2014['febrero']=$ano_2014['febrero'] + $cantidad;		}
		if ($mes=='03') 	{		$ano_2014['marzo']=$ano_2014['marzo'] + $cantidad;		}
		if ($mes=='04') 	{		$ano_2014['abril']=$ano_2014['abril'] + $cantidad;		}
		if ($mes=='05') 	{		$ano_2014['mayo']=$ano_2014['mayo'] + $cantidad;		}
		if ($mes=='06') 	{		$ano_2014['junio']=$ano_2014['junio'] + $cantidad;		}
		if ($mes=='07') 	{		$ano_2014['julio']=$ano_2014['julio'] + $cantidad;		}
		if ($mes=='08') 	{		$ano_2014['agosto']=$ano_2014['agosto'] + $cantidad;		}
		if ($mes=='09') 	{		$ano_2014['septiembre']=$ano_2014['septiembre'] + $cantidad;		}
		if ($mes=='10') 	{		$ano_2014['octubre']=$ano_2014['octubre'] + $cantidad;		}
		if ($mes=='11') 	{		$ano_2014['noviembre']=$ano_2014['noviembre'] + $cantidad;		}
		if ($mes=='12') 	{		$ano_2014['diciembre']=$ano_2014['diciembre'] + $cantidad;		}
				
		
	}

	

}


$ejey2013= '['.$ano_2013['enero'].','.$ano_2013['febrero'].','.$ano_2013['marzo'].','.$ano_2013['abril'].','.$ano_2013['mayo'].','.$ano_2013['junio'].','.$ano_2013['julio'].','.$ano_2013['agosto'].','.$ano_2013['septiembre'].','.$ano_2013['octubre'].','.$ano_2013['noviembre'].','.$ano_2013['diciembre'].']';

$ejey2014= '['.$ano_2014['enero'].','.$ano_2014['febrero'].','.$ano_2014['marzo'].','.$ano_2014['abril'].','.$ano_2014['mayo'].','.$ano_2014['junio'].','.$ano_2014['julio'].','.$ano_2014['agosto'].','.$ano_2014['septiembre'].','.$ano_2014['octubre'].','.$ano_2014['noviembre'].','.$ano_2014['diciembre'].']';




?>







<!-- **************************************************************************************************************************** -->
<div align="center" style="background-color: transparent;"  >
<br/>
<h3>Año 2013</h3>

<script src="js/Chart.js"></script>
<canvas id="grafica1" height="500" width="800"></canvas>
<script>
		var datos = {
			labels : ["Enero 2013", "Febrero 2013", "Marzo 2013", "Abril 2013", "Mayo 2013", "Junio 2013", "Julio 2013", "Agosto 2013", "Septiembre 2013", "Octubre 2013", "Noviembre 2013", "Diciembre 2013"],
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : <?php  echo $ejey2013 ?>
				}
			]
			
		}
	var linea = new Chart(document.getElementById("grafica1").getContext("2d")).Line(datos);
</script>
</div>
<!-- **************************************************************************************************************************** -->
<br/>
<!-- **************************************************************************************************************************** -->
<div align="center" style="background-color: transparent;" >
<br/>
<h3>Año 2014</h3>

<script src="js/Chart.js"></script>
<canvas id="grafica2" height="500" width="800"></canvas>
<script>
		var datos = {
			labels : ["Enero 2014", "Febrero 2014", "Marzo 2014", "Abril 2014", "Mayo 2014", "Junio 2014", "Julio 2014", "Agosto 2014", "Septiembre 2014", "Octubre 2014", "Noviembre 2014", "Diciembre 2014"],
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : <?php  echo $ejey2014 ?>
				}
			]
			
		}
	var linea = new Chart(document.getElementById("grafica2").getContext("2d")).Line(datos);
</script>
</div>
<!-- **************************************************************************************************************************** -->
<br/>
<br/>
<!-- **************************************************************************************************************************** -->
<?php
include("pie.php");
mysql_close($conexion);
?>

