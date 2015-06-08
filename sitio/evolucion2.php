<?php
include ("cabecera_inicio.php");
include ("funciones.php");


echo '<h2>Balance global a lo largo del tiempo</h2>';
echo '<span>El eje horizontal representa el número de comunes que se han movido ese mes. Mientras más larga sea la barra horizontal más movimiento de comunes por mes.</span><br>';

$ano_2013= array('enero'=>0, 'febrero'=>0, 'marzo'=>0, 'abril'=>0,'mayo'=>0, 'junio'=>0, 'julio'=>0, 'agosto'=>0, 'septiembre'=>0, 'octubre'=>0, 'noviembre'=>0, 'diciembre'=>0,);

$ano_2014= array('enero'=>0, 'febrero'=>0, 'marzo'=>0, 'abril'=>0,'mayo'=>0, 'junio'=>0, 'julio'=>0, 'agosto'=>0, 'septiembre'=>0, 'octubre'=>0, 'noviembre'=>0, 'diciembre'=>0,);

$ano_2015= array('enero'=>0, 'febrero'=>0, 'marzo'=>0, 'abril'=>0,'mayo'=>0, 'junio'=>0, 'julio'=>0, 'agosto'=>0, 'septiembre'=>0, 'octubre'=>0, 'noviembre'=>0, 'diciembre'=>0,);

$con=conectar_base_datos();
/*********** selecciona todos los importes *******/
$result = mysqli_query($con, "SELECT CANTIDAD, FECHA FROM pagos");

while($row = mysqli_fetch_array($result))
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
	$mayor_2013=max($ano_2013);
	
	$total_2013=0;
	foreach ($ano_2013 as $valor) 
	{
		$total_2013=$total_2013+$valor;
	}



	if ($ano=='2014')
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
	$mayor_2014=max($ano_2014);
	
	$total_2014=0;
	foreach ($ano_2014 as $valor) 
	{
		$total_2014=$total_2014+$valor;
	}	
	
	
	if ($ano=='2015')
	{
		if ($mes=='01') 	{		$ano_2015['enero']=$ano_2015['enero'] + $cantidad;		}
		if ($mes=='02') 	{		$ano_2015['febrero']=$ano_2015['febrero'] + $cantidad;		}
		if ($mes=='03') 	{		$ano_2015['marzo']=$ano_2015['marzo'] + $cantidad;		}
		if ($mes=='04') 	{		$ano_2015['abril']=$ano_2015['abril'] + $cantidad;		}
		if ($mes=='05') 	{		$ano_2015['mayo']=$ano_2015['mayo'] + $cantidad;		}
		if ($mes=='06') 	{		$ano_2015['junio']=$ano_2015['junio'] + $cantidad;		}
		if ($mes=='07') 	{		$ano_2015['julio']=$ano_2015['julio'] + $cantidad;		}
		if ($mes=='08') 	{		$ano_2015['agosto']=$ano_2015['agosto'] + $cantidad;		}
		if ($mes=='09') 	{		$ano_2015['septiembre']=$ano_2015['septiembre'] + $cantidad;		}
		if ($mes=='10') 	{		$ano_2015['octubre']=$ano_2015['octubre'] + $cantidad;		}
		if ($mes=='11') 	{		$ano_2015['noviembre']=$ano_2015['noviembre'] + $cantidad;		}
		if ($mes=='12') 	{		$ano_2015['diciembre']=$ano_2015['diciembre'] + $cantidad;		}	

	}
	$mayor_2015=max($ano_2015);	

	$total_2015=0;
	foreach ($ano_2015 as $valor) 
	{
		$total_2015=$total_2015+$valor;
	}
	
}

$mayor_mes_todos=max($mayor_2013, $mayor_2014, $mayor_2015);	
	
mysqli_close($con);
?>


<!-- **************************************** 2013 *************************************************************************** -->
<table   style="width:100%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;" >
<tr><th style="background-color:#4F7088"><h3 align="left" style="color:white;" >Año 2013</h3></th></tr>
<tr>
<td>


<table style="width:<?php echo round(($ano_2013['enero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color: #242;" class="bordes_redondeados"><?php echo 'Enero: '. $ano_2013['enero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['febrero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr  ><th style="background-color:#242;" class="bordes_redondeados" ><?php echo 'Febrero: ' . $ano_2013['febrero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['marzo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Marzo: ' .$ano_2013['marzo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['abril']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Abril: ' . $ano_2013['abril']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['mayo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Mayo: ' . $ano_2013['mayo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['junio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Junio: ' . $ano_2013['junio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['julio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Julio: ' . $ano_2013['julio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['agosto']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Agosto: ' . $ano_2013['agosto']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['septiembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Septiembre: ' . $ano_2013['septiembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['octubre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Octubre: '. $ano_2013['octubre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['noviembre']/$mayor_mes_todos)*80,0)+15 ?>%;  padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Noviembre: ' . $ano_2013['noviembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2013['diciembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Diciembre: '. $ano_2013['diciembre']; ?></th>	</tr>
</table>


</td>
</tr>

<tr><td>Total de comunes en el primer trimestre:  <?php echo $ano_2013['enero']+$ano_2013['febrero']+$ano_2013['marzo'] ?></td></tr>
<tr><td>Total de comunes en el segundo trimestre:  <?php echo $ano_2013['abril']+$ano_2013['mayo']+$ano_2013['junio'] ?></td></tr>
<tr><td>Total de comunes en el tercer trimestre:  <?php echo $ano_2013['julio']+$ano_2013['agosto']+$ano_2013['septiembre'] ?></td></tr>
<tr><td>Total de comunes en el cuarto trimestre:  <?php echo $ano_2013['octubre']+$ano_2013['noviembre']+$ano_2013['diciembre'] ?></td></tr>


<tr><td><h3>Total de comunes en el año 2013: <?php echo $total_2013 ?></h3></td></tr>

</table>
<br>

<!-- **************************************** 2014*************************************************************************** -->
<table  width="100%">
<tr><th style="background-color:#4F7088"><h3 align="left" style="color:white;" >Año 2014</h3></th></tr>
<tr>
<td>


<table style="width:<?php echo round(($ano_2014['enero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Enero: '. $ano_2014['enero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['febrero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados" ><?php echo 'Febrero: ' . $ano_2014['febrero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['marzo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Marzo: ' .$ano_2014['marzo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['abril']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Abril: ' . $ano_2014['abril']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['mayo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Mayo: ' . $ano_2014['mayo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['junio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Junio: ' . $ano_2014['junio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['julio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Julio: ' . $ano_2014['julio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['agosto']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Agosto: ' . $ano_2014['agosto']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['septiembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Septiembre: ' . $ano_2014['septiembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['octubre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Octubre: '. $ano_2014['octubre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['noviembre']/$mayor_mes_todos)*80,0)+15 ?>%;  padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Noviembre: ' . $ano_2014['noviembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2014['diciembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Diciembre: '. $ano_2014['diciembre']; ?></th>	</tr>
</table>


</td>
</tr>

<tr><td>Total de comunes en el primer trimestre:  <?php echo $ano_2014['enero']+$ano_2014['febrero']+$ano_2014['marzo'] ?></td></tr>
<tr><td>Total de comunes en el segundo trimestre:  <?php echo $ano_2014['abril']+$ano_2014['mayo']+$ano_2014['junio'] ?></td></tr>
<tr><td>Total de comunes en el tercer trimestre:  <?php echo $ano_2014['julio']+$ano_2014['agosto']+$ano_2014['septiembre'] ?></td></tr>
<tr><td>Total de comunes en el cuarto trimestre:  <?php echo $ano_2014['octubre']+$ano_2014['noviembre']+$ano_2014['diciembre'] ?></td></tr>


<tr><td><h3>Total de comunes en el año 2014: <?php echo $total_2014 ?></h3></td></tr>

</table>
<br>




<!-- **************************************** 2015 *************************************************************************** -->
<table  width="100%">
<tr><th style="background-color:#4F7088"><h3 align="left" style="color:white;" >Año 2015</h3></th></tr>
<tr>
<td>


<table style="width:<?php echo round(($ano_2015['enero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Enero: '. $ano_2015['enero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['febrero']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados" ><?php echo 'Febrero: ' . $ano_2015['febrero']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['marzo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Marzo: ' .$ano_2015['marzo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['abril']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Abril: ' . $ano_2015['abril']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['mayo']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Mayo: ' . $ano_2015['mayo']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['junio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Junio: ' . $ano_2015['junio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['julio']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Julio: ' . $ano_2015['julio']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['agosto']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Agosto: ' . $ano_2015['agosto']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['septiembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Septiembre: ' . $ano_2015['septiembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['octubre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Octubre: '. $ano_2015['octubre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['noviembre']/$mayor_mes_todos)*80,0)+15 ?>%;  padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Noviembre: ' . $ano_2015['noviembre']; ?></th>	</tr>
</table>

<table style="width:<?php echo round(($ano_2015['diciembre']/$mayor_mes_todos)*80,0)+15 ?>%; padding:0; margin:0; border:0; font-size:1em; line-height:1em;">
<tr><th style="background-color:#242;" class="bordes_redondeados"><?php echo 'Diciembre: '. $ano_2015['diciembre']; ?></th>	</tr>
</table>


</td>
</tr>

<tr><td>Total de comunes en el primer trimestre:  <?php echo $ano_2015['enero']+$ano_2015['febrero']+$ano_2015['marzo'] ?></td></tr>
<tr><td>Total de comunes en el segundo trimestre:  <?php echo $ano_2015['abril']+$ano_2015['mayo']+$ano_2015['junio'] ?></td></tr>
<tr><td>Total de comunes en el tercer trimestre:  <?php echo $ano_2015['julio']+$ano_2015['agosto']+$ano_2015['septiembre'] ?></td></tr>
<tr><td>Total de comunes en el cuarto trimestre:  <?php echo $ano_2015['octubre']+$ano_2015['noviembre']+$ano_2015['diciembre'] ?></td></tr>


<tr><td><h3>Total de comunes en el año 2015: <?php echo $total_2015 ?></h3></td></tr>

</table>
<br>

<!-- ************************************************************************************************************************* -->
<?php include("pie.php"); ?>

