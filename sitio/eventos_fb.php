<div id='agenda'>
				<div>
					<h2 style="color: #2a9c64; font-size:1.5em; font-weight:bold">Agenda de la red malagueña de Iniciativas de Transición</h2>
					<h4 style="font-size:1.2em"><b>¡Ven a conocernos!</b></h4>
					<p><b>Si formas parte de un colectivo ecologista de Málaga provincia y os gustaría que los eventos de su página de Facebook aparezcan aquí, háznoslo saber en dinamizacion @ malagacomun.org</b></p>
					<hr /><br>					
				</div>
				<div>
					<?php
							$malagacomun_id = "214703095332119";
							$la_salvia_id = "248839228648918";
							$jaulas_abiertas_id = "894303897266343";
							$casa_comestible_id = "217083815111127";
							$elcaminito_id = "334700799976100";
							$ecologistas_accion_malaga_id = "350131268350225";
							mostrar_eventos($malagacomun_id,'Málaga Común');						
							mostrar_eventos($la_salvia_id, 'Aula Vivero La Salvia');
							mostrar_eventos($jaulas_abiertas_id,'Jaulas Abiertas');
							mostrar_eventos($casa_comestible_id,'Casa Comestible');							
							mostrar_eventos($elcaminito_id, 'El Caminito');
							mostrar_eventos($ecologistas_accion_malaga_id, 'Ecologistas en Acción Málaga');							
					?>
				</div>
</div>

<?php
function mostrar_eventos($fb_page_id, $nombre)
{
	// get upcoming events for the next x years
	$year_range = 1;
	// automatically adjust date range
	// human readable years
	$since_date = date('d-m-Y');
	$until_date = date('31-12-Y', strtotime('+' . $year_range . ' years'));
	// unix timestamp years
	$since_unix_timestamp = strtotime($since_date);
	$until_unix_timestamp = strtotime($until_date);
	$access_token = "629662847134257|Hvc3KEjmDOJoYQL-LbvVH1EiOww";
	$fields="id,name,description,location,venue,timezone,start_time,cover";
	$ev_link = "https://graph.facebook.com/{$fb_page_id}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";
	$ev_json = file_get_contents($ev_link);
	$ev = json_decode($ev_json, true);
	$event_count = count($ev['data']);
	if ($event_count > 0)
	{	echo "<h3 style='color: #2d9e68; font-weight:bold'>$nombre</h3><br>";
		mostrar_tabla($event_count,$ev,$fb_page_id);
	}
//$ev_mc = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
} //mostrar_eventos

function mostrar_tabla ($event_count,$ev,$fb_page_id)
{
echo "<div id='agenda_fb'>";
		for($x=$event_count-1; $x>=0; $x--){
			// facebook events will be here
			$start_date = date( 'd F Y', strtotime($ev['data'][$x]['start_time']));  
			// ajustar la hora a la de facebook
			$start_time = date('H:i', strtotime($ev['data'][$x]['start_time']));
			$pic = isset($ev['data'][$x]['cover']['source']) ? $ev['data'][$x]['cover']['source'] : "https://graph.facebook.com/{$fb_page_id}/picture?type=normal";
			$eid = $ev['data'][$x]['id'];
			$name = $ev['data'][$x]['name'];
			$location = isset($ev['data'][$x]['location']) ? $ev['data'][$x]['location'] : "";
			$description = isset($ev['data'][$x]['description']) ? $ev['data'][$x]['description'] : "";

			echo "<table id='evento_fb'>";
			echo "<tr>";
				echo "<td style='text-align:left'><h5>{$start_date} a las {$start_time}h</h5>{$location}<br><br><h3>{$name}</h3><br><a href='https://www.facebook.com/events/{$eid}/' target='_blank'>Ver evento en Facebook</a></td>";
				echo "<td style='text-align:center'><a href='{$pic}'><img src='{$pic}' height='350px'</a></img></td>";
			echo "</tr>"; 
			/*echo "</tr>";
			echo "<tr  colspan='2'>";
				//echo "<td>Description:</td>";
				echo "<td align='left' colspan='2'>{$description}</td>";
			echo "</tr>"; */
			echo "</table>";
			echo "<hr />";
			echo "<br><br>";
		} //end for
echo "</div>";
} //mostrar_tabla
?>
