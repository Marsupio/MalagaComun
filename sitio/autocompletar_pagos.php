<?php
/* primero hay que recopilar todos los nombres y emails de la tabla de pagos y pasarlos a una variable javascript*/
$con = conectar_base_datos();

$qry1 = "SELECT DISTINCT PAGADOR, EMAIL_PAGADOR FROM pagos";
$rs = mysqli_query($con, $qry1);
$usr = mysqli_fetch_array($rs);
$i = 0;
while ($usr)
	{
	$cadena = $usr['PAGADOR'].' <'.$usr['EMAIL_PAGADOR'].'>';
	$array_pagadores[$i++] = quitar_tildes ($cadena); 
	$usr = mysqli_fetch_array($rs);
	}
	
$qry2 = "SELECT DISTINCT RECEPTOR, EMAIL_RECEPTOR FROM pagos";
$rs = mysqli_query($con, $qry2);
$usr = mysqli_fetch_array($rs);
$i = 0;
while ($usr)
	{
	$cadena = $usr['RECEPTOR'].' <'.$usr['EMAIL_RECEPTOR'].'>';
	$array_receptores[$i++] = quitar_tildes ($cadena); 
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
var pagadores_js = <?php echo json_encode($array_pagadores); ?>; 
var receptores_js = <?php echo json_encode($array_receptores); ?>; 

    $('#autocomplete-custom-append-1').autocomplete({
        lookup: pagadores_js,
        appendTo: '#suggestions-container-1',
		minChars: 3
    });
	$('#autocomplete-custom-append-2').autocomplete({
        lookup: receptores_js,
        appendTo: '#suggestions-container-2',
		minChars: 3
    });
});
</script>