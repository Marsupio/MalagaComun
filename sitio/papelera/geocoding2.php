
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
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBzzuKDc1J7DppdVVxvhoIeNzixM2HPBHw&sensor=false"></script>
<!-- ***************************************************************************************************************************** -->
<script type="text/javascript">




    // obtenemos el array de valores mediante la conversion a json del array de php	   
	 var arrayJS = [
	 
	 [36.7201,-4.4149],
	 [36.7301,-4.4149],
	 [36.7401,-4.4149],
	 [36.7411,-4.4109],
	 [36.7421,-4.4139],
	 [36.7431,-4.4179],
	 [36.7441,-4.4119],
	 [36.7341,-4.4619],
	 [36.7341,-4.4219],
	 [36.7241,-4.4919],
	 [36.7481,-4.4279],
	 [36.7431,-4.4219],
	 [36.7311,-4.4119],
	 [36.7041,-4.4239],
	 [36.7201,-4.4859],	 
	 [36.7401,-4.4270],
	 [36.7401,-4.4019],
	 [36.730,-4.4119],
	 [36.7341,-4.4339],
	 [36.7101,-4.4669],	 	 
	 
	 ]; 

	//inicializo el array de las marcas de los usuarios
	var vecinos = [];		
	    
    // procesamos  los valores del array de coordenadas
    for(var i=0; i<=arrayJS.length; i++)
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
    }, i * 100);
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