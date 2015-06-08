<script src="Chart.js"></script>

<canvas id="grafica" height="400" width="600"></canvas>

<?php 
 $meses = '["Enero","February","March","April","May","June","July", "Agosto", "Septiembre", "Noviembre", "Diciembre"]';
 $valores = '[28,28,40,19,96,27,150,45,67,11,60]';

?>

<script>
		var datos = {
			labels : <?php echo $meses ?>,
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : <?php echo $valores ?>
				}
			]
			
		}
	var linea = new Chart(document.getElementById("grafica").getContext("2d")).Line(datos);
</script>

