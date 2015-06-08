<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM demandas WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql); 

	if (mysqli_num_rows($rs)!=0)
	{ 
		$demanda=obten_demanda_por_id($id);		
			
		$titulo=$demanda['TITULO'];
		$cuerpo=$demanda['CUERPO'];
		$categoria=$demanda['CATEGORIA'];
		$email=$demanda['EMAIL'];
		$fecha=$demanda['FECHA'];
		$localizacion=$demanda['LOCALIZACION'];
		$foto=$demanda['FOTO'];

		if ($foto!='defecto.jpg')
		{		
				$foto=str_replace('demanda', 'oferta', $foto);
		}
		
   		//anuncio encontrado,  lo borro de las demandas y lo inserto en demandas
		mysqli_query($con,"DELETE FROM demandas WHERE (ID='$id')");
		
		
		mysqli_query($con, "insert into ofertas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$foto')");
	
		
		

		echo '<br />';
		echo '<b>Se ha cambiado este anuncio al tipo OFERTA.</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_ofertas.php">Pulse aquí para volver</a>';
		echo '<br>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<br />';
		echo '<b>No existe esa demanda en el sistema</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_demandas.php">Pulse aquí para volver</a>';
		echo '<br>';	
	}


include("pie.php");
mysqli_close($con);
?>