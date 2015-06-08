<?php
/* primero hay que recopilar todos los nombres, apellidos y emails de los usuarios de la bd y pasarlos a una variable javascript*/
$mi_email=$_SESSION['EMAIL'];
$con = conectar_base_datos();
$qry = "SELECT NOMBRE,APELLIDOS,EMAIL FROM usuarios WHERE EMAIL != '$mi_email'";
$rs = mysqli_query($con, $qry);
$usr = mysqli_fetch_array($rs);
$i = 0;
while ($usr)
	{
	$cadena = $usr['NOMBRE'].' '.$usr['APELLIDOS'].' <'.$usr['EMAIL'].'>';
	$array_nombres[$i++] = quitar_tildes ($cadena); 
	$usr = mysqli_fetch_array($rs);
	}
mysqli_close($con);
 
function quitar_tildes($str) {
	$contil = array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú");
	$sintil = array ("a","e","i","o","u","A","E","I","O","U");
	$texto = str_replace($contil, $sintil, $str);
	return $texto;
}
?> 

<script type="text/javascript">
/*jslint  browser: true, white: true, plusplus: true */
/* global $, array_nombres */

$(function () {
'use strict';
var nombres_js = <?php echo json_encode($array_nombres); ?>; 

    $('#autocomplete-custom-append').autocomplete({
        lookup: nombres_js,
        appendTo: '#suggestions-container',
		minChars: 3
    });
});
</script>