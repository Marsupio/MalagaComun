<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM ofertas WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysql_query($ssql,$con); 

	if (mysql_num_rows($rs)!=0)
	{ 
		$oferta=obten_oferta_por_id($id);		
			
		$titulo=$oferta['TITULO'];
		$cuerpo=$oferta['CUERPO'];
		$categoria=$oferta['CATEGORIA'];
		$email=$oferta['EMAIL'];
		$fecha=$oferta['FECHA'];
		$localizacion=$oferta['LOCALIZACION'];
		$foto=$oferta['FOTO'];
		
		if ($foto!='defecto.jpg')
		{
			$foto=str_replace('oferta', 'demanda', $foto);
		}
		
   		//anuncio encontrado,  lo borro de las ofertas y lo inserto en demandas
		mysql_query("DELETE FROM ofertas WHERE (ID='$id')");
		
		
		mysql_query("insert into demandas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$foto')");
	
		
		

		echo '<br />';
		echo '<b>Se ha cambiado este anuncio al tipo DEMANDA.</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_demandas.php">Pulse aquí para volver</a>';
		echo '<br>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<br />';
		echo '<b>No existe esa oferta en el sistema</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_ofertas.php">Pulse aquí para volver</a>';
		echo '<br>';	
	}


include("pie.php");
mysql_close($con);
?>