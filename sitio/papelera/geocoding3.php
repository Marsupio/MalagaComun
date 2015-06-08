<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mapa de Usuarios</title>
 <!-- **************************************************************************************************************** -->               
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px;		
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
<!-- ******************************************************************************************************** -->
<!--
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKtPz5HssSvfAHRRUCe7zE1E_jA9oHm1o&sensor=false"></script>
-->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<!-- ******************************************************************************************************** -->
<?php

include ('funciones.php');

ini_set('max_execution_time', 0);

/****************************************************************************/
function direccion_a_coord($address)
{
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
    $response = file_get_contents($url);
    $json = json_decode($response,true);
 
    $lat = $json['results'][0]['geometry']['location']['lat'];
    $lng = $json['results'][0]['geometry']['location']['lng'];
	
	
 
    return array($lat, $lng);
}
/********************************************************************************/
$conexion=conectar_base_datos();

	$rs = mysql_query("SELECT CP FROM usuarios");

	$codigos=array();
	while($fila = mysql_fetch_array($rs))
	{	
		$cp=$fila['CP'];
		if ($cp!=0)
		{
			array_push($codigos, $cp);	
		}
		
	}


mysql_close($conexion);
/********************************************************************************/
$total=count($codigos);
echo 'Sólo <b>'.$total.'</b> usuarios han indicado su código postal.';

$coords=array();

for ($i=0; $i<=$total-1; $i++)
{
		$cp=$codigos[$i];
		$coord=direccion_a_coord($cp.',malaga,spain');
		
		

		array_push($coords,$coord);	
	
	$cp++;
	
	
}

?>
<!-- ******************************************************************************************************** -->
<script type="text/javascript">

	var vecinos = [];		

    // obtenemos el array de valores mediante la conversion a json del array de php
    var arrayJS=<?php echo json_encode($coords);?>;
	    
    // procesamos  los valores del array
    for(var i=0; i<arrayJS.length; i++)
    {
		
		var coord=arrayJS[i];
		var latitud = coord[0];
		var longitud = coord[1];

		var marca =  new google.maps.LatLng(latitud,longitud);
		vecinos[i]=marca;	
			
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
  var mapOptions = { zoom: 13, center: malaga};
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function drop() 
{
  for (var i = 0; i < vecinos.length; i++) {
    setTimeout(function() {
      addMarker();
    }, i * 300);
  }
}

function addMarker() {
  markers.push(new google.maps.Marker({
    position: vecinos[iterator],
    map: map,
    draggable: false,
    animation: google.maps.Animation.DROP
  }));
  iterator++;
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
 <!-- **************************************************************************************************************** -->   
</head>
<body>

    <div id="panel"> 
     		<button style="font-size:1.2em;"  onclick="drop()">Ver usuarios</button>  
    </div>

    <div id="map-canvas"></div>

 <!-- **************************************************************************************************************** -->   



</body>
</html>