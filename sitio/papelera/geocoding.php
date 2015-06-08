<?php
		
			include ('funciones.php');

			$array_fichero=array();
			$file = fopen ("marcas.txt", "r");
			while (!feof($file) ) 
			{
					$linea = fgets($file);
					array_push($array_fichero, $linea);
			}
			fclose ($file);
			
			
			$array_asociativo = array ();
			foreach ($array_fichero as $valor)
			{
				$cp=substr($valor,0,5);
				$latitud=substr($valor,6,6);
				$longitud=substr($valor,17,6);
			
				$nuevo = array ('cp' => $cp, 'latitud' => $latitud, 'longitud' => $longitud);
				array_push($array_asociativo, $nuevo);
			}
			
			
			$codigos=codigos_postales();
			$total=count($codigos);
			$coords=array();
			for ($i=0; $i<=$total-1; $i++)
			{
					$cp=$codigos[$i];		
					$coord=obten_coord_desde_array($array_asociativo, $cp);
					array_push($coords,$coord);	
			}
		
?>
<!-- ***************************************************************************************************************************** -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mapa de Usuarios</title>
 <!-- **************************************************************************************************************** -->               
 
    <style>
      html, body, #map-canvas 
	  {
        height: 100%;
        margin: 0px;
        padding: 0px;	
		border: 0px;
		
		background-color: #eee;	
      }
	  
	  #panel
	  {
		  position:absolute;
		  top:20px;
		  left:50%;
		  z-index:5;
		  text-align:center;
	  }

    </style>
<!-- ***************************************************************************************************************************** -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- ***************************************************************************************************************************** -->
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
		
		latitud=parseFloat(latitud);
		longitud=parseFloat(longitud);
		
		var marca =  new google.maps.LatLng(latitud,longitud);
		vecinos[i]=marca;	

    }

</script>
<!-- ************************************************************************************************************************************* -->
<script type="text/jscript">

var markers = [];
var iterator = 0;
var map;
var malaga = new google.maps.LatLng(36.720119356522154,-4.41493347287178);

function initialize()
 {
  var mapOptions = { zoom: 11, center: malaga};
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function drop() 
{
  for (var i = 0; i < vecinos.length; i++) {
    setTimeout(function() {
      addMarker();
    }, i * 500);
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

drop();

</script>
 <!-- **************************************************************************************************************** -->   
</head>
<body>
		
      <div id="panel">
     		 <a href="http://www.malagacomun.org/sitio/usuarios.php"><img src="../images/avatar.png" alt="" height="75px" /></a>

      </div>  
    
    <div id="map-canvas"></div>

 <!-- **************************************************************************************************************** -->   



</body>
</html>