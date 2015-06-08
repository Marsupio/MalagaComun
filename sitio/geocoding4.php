<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mapa de Usuarios</title>
 <!-- **************************************************************************************************************** -->               
    <style>
      html, body, #map-canvas {
        height: 98%;
        margin: 0;
        padding: 0;		
		border:0;
		background-color:white;
      }
	  
      #panel 
	  {
        position: absolute;
        top: 20px;
        margin-left: 100px;
        z-index: 5;
        padding: 10px;
      }
	  
    </style>
 <!-- **************************************************************************************************************** -->           
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- ******************************************************************************************************** -->
<?php

include ('funciones.php');

// ini_set('max_execution_time', 0);

/********************************************************************************/
$con=conectar_base_datos();

///////// obtengo los códigos postales  /////////////////////////////////
	$rs = mysqli_query($con, "SELECT CP FROM usuarios");

	$codigos=array();
	while($fila = mysqli_fetch_array($rs))
	{	
		$cp=$fila['CP'];
		if ($cp!=0)
		{
			array_push($codigos, $cp);	
		}
		
	}
	
$array_coordenadas=array();

$total=count($codigos);
for ($i=0; $i<$total; $i++)
{
	$actual=$codigos[$i];
 	$coordenadas=dame_coordenas($con, $actual);
	
	array_push($array_coordenadas, $coordenadas);

}

/////////////////////////////////////////////////////
mysqli_close($con);

echo 'Sólo '.$total.' usuarios han indicado su código postal';

/////// asocio los codigos postales con sus coordenadas gps //////////////
function dame_coordenas($con, $cp)
		{
		$rs2 = mysqli_query($con, "SELECT * FROM direcciones WHERE CP='$cp'");
		$fila = mysqli_fetch_array($rs2);

		$latitud=$fila['LATITUD'];
		$longitud=$fila['LONGITUD'];

		$coodenadas=array();
		$coodenadas['latitud']=$latitud;
		$coodenadas['longitud']=$longitud;

		return $coodenadas;

		}
?>
<script type="text/javascript">

	var usuarios = [];		

    // obtenemos el array de valores mediante la conversion a json del array de php
    var arrayJS=<?php echo json_encode($array_coordenadas);?>;
	
   
    // procesamos  los valores del array
    for(var i=0; i<arrayJS.length; i++)
    {
		
		var coord=arrayJS[i];
		var latitud = coord['latitud'];
		var longitud = coord['longitud'];

		var marca =  new google.maps.LatLng(latitud,longitud);
		usuarios[i]=marca;	
			
    }

</script>
<!-- ******************************************************************************************************** -->
<script type="text/jscript">

var markers = [];
var iterator = 0;
var map;
var malaga = new google.maps.LatLng(36.720119356522154,-4.41493347287178);

function initialize()
 {
  var mapOptions = { zoom: 10, center: malaga};
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function drop() 
{
  for (var i = 0; i < usuarios.length; i++) {
    setTimeout(function() {
      addMarker();
    }, i * 10);
  }
}

function addMarker() {
  markers.push(new google.maps.Marker({
    position: usuarios[iterator],
    map: map,
    draggable: false,
    animation: google.maps.Animation.DROP
  }));
  iterator++;
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
  
</head>
<body>

    <div id="panel"> 
		<script type="text/jscript">drop()</script>
    </div>

    <div id="map-canvas"></div>

</body>
</html>