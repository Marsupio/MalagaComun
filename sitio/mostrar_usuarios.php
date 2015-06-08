<?php
include ("funciones.php");
include ("cabecera_inicio.php");
//*********************************************************************************************//
?>
<link rel="stylesheet" href="tabla/style.css" />
<h2>Buscador de usuarios</h2>
<p>Escribe algún dato de la persona que conozcas, tal como su nombre o apellidos en el cuadro de búsqueda siguiente.</p>


<div id="tablewrapper">
<!-- *************************************** -->        
		<div id="tableheader">
        
        	<div class="search">
                    <span>&nbsp;Escribe aquí algún dato que conozca de la persona para poder buscarlo:  &nbsp;</span><br/>
                    <input type="text" id="query" onkeyup="sorter.search('query')" />
                    <select id="columns" onchange="sorter.search('query')"></select>
                    
            </div>
            
            <div class="details">
				<div>Registros&nbsp;<span id="startrecord"></span>-<span id="endrecord"></span>&nbsp;de&nbsp;<span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">Reiniciar</a></div>
        	</div>
            
        </div>
 <!-- *************************************** -->        
        
<table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th><h3>Nombre</h3></th>
					<th><h3>Apellidos</h3></th>
                 </tr>
            </thead>
            
		<tbody>
		<!-- *************************************************************** -->            
		 <?php           
		$conexion=conectar_base_datos();

		$result = mysqli_query($conexion, "SELECT * FROM usuarios order by APELLIDOS");
		$cantidad=mysqli_num_rows($result);

		while($row = mysqli_fetch_array($result))
		{
			  $nombre=$row['NOMBRE'];
			  $apellidos=$row['APELLIDOS'];
			  $email=$row['EMAIL'];

				if ($nombre=='') { $nombre='&bull;&bull;&bull;'; }
				if ($apellidos=='') { $apellidos='&bull;'; }

			  echo '<tr>';
			  
			  echo '<td>'. $nombre .'</td>';
			  echo '<td>'. $apellidos.'</td>';
			  echo "<td><a class='button' href='mostrar_usuario.php?email=$email'>Detalles</a></td>";
			  
			  echo '</tr>';

		}
		mysqli_close($conexion);
		?>
		<!-- ***************************************************************** -->                
		</tbody>
</table>

        
        
<div id="tablefooter">
<!-- *************************************** -->        
          <div id="tablenav">

                <div>
               		 Seleccione el número de página:&nbsp; 
                	<select id="pagedropdown"></select>
				</div>
                
                <br/>
                          
            	<div>
                    <img src="tabla/images/first.png" width="32" height="20" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="tabla/images/previous.png" width="32" height="20" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="tabla/images/next.png" width="32" height="20" alt="First Page" onclick="sorter.move(1)" />
                    <img src="tabla/images/last.png" width="32" height="20" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                

                
                
            </div>
<!-- *************************************** -->   
                <div class="page">
                			Página <span id="currentpage"></span> de <span id="totalpages"></span>
                </div>            
<!-- *************************************** -->                    
			<div id="tablelocation">
            	<div>
                    <span>Resultados por página:  &nbsp;</span>                
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

<!-- *************************************** -->   
                <div class="ver_todos">
                	<a class="button" href="javascript:sorter.showall()">Ver Todos</a>
                </div>
 <!-- *************************************** -->   
               
     
</div> <!-- de tablefooter -->        

</div> <!-- de tablewrapper -->        

	<script type="text/javascript" src="tabla/script.js"></script>   
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:false,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'$', decimals:0},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>



<?php include("pie.php");  ?>

