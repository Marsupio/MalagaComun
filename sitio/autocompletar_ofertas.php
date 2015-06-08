<?php
include 'conectar_bd.php';
/* primero hay que recopilar todas las ofertas de la bd y pasarlos a una variable javascript*/

$con = conectar_base_datos();
$qry = "SELECT TITULO, ETIQUETAS FROM ofertas ORDER BY ID DESC";
$rs = mysqli_query($con, $qry);
$oft = mysqli_fetch_array($rs);
$i = 0;
while ($oft)
	{
	$cadena = $oft['TITULO']." <".$oft['ETIQUETAS'].">";
	$array_ofertas[$i++] = quitar_tildes ($cadena); 
	$oft = mysqli_fetch_array($rs);
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
var ofertas_js = <?php echo json_encode($array_ofertas); ?>; 

    $('#autocomplete-custom-append').autocomplete({
        lookup: ofertas_js,
        appendTo: '#suggestions-container',
		minChars: 3
    });
});
</script>