<?php
//Me conecto a la base de datos
$con=conectar_base_datos();
//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM categorias order by categoria asc"; 
//Ejecuto la sentencia 
$rs = mysqli_query($con,$ssql); 

echo '<SELECT id="formulario2" name="categoria">';
echo '<OPTION VALUE="TODAS LAS CATEGORIAS">TODAS LAS CATEGORIAS</OPTION>';

while ($row=mysqli_fetch_array ($rs)) 
{
	$categoria=$row['categoria'];
	echo '<OPTION VALUE="'.$categoria.'">'.$categoria.'</OPTION>'; 
}
echo '<OPTION VALUE="OTRA CATEGORIA DISTINTA A LAS LISTADAS">OTRA CATEGORIA DISTINTA A LAS LISTADAS</OPTION>';
echo '</SELECT>';

mysqli_close($con);
?>
