<div id="contenedor_menu">
             
<ul id="menu">
	<li>
		<a href="#"><i class="fa fa-desktop"></i><span style="padding-left:2em;">Consultar Datos</span></a>
		<ul>
				<a href="#"><span style="padding-left:2em;"><i class="fa fa-group"></i></span><span style="padding-left:2em;">Comunidad</span></a>
					<ul>							
							<li><a href="cuenta_comunitaria.php">Cuenta Comunitaria</a></li>
							<li><a href="fondo_comunitario.php">Fondo Comunitario</a></li>
                            <li><a href="geocoding4.php"  target="_blank">Mapa de Usuarios</a></li>  
					</ul>
				<a href="#"><span style="padding-left:2.3em;"><i class="fa fa-user"></i></span><span style="padding-left:2em;">Mis Datos</span></a>
					<ul>
							<li><a href="usuario.php">Mi perfil</a></li>
							<li><a href="mis_anuncios.php">Mis anuncios publicados</a></li>
							<li><a href="mis_pagos_realizados.php">Mis pagos realizados</a> </li>
                            <li><a href="mis_pagos_recibidos.php">Mis pagos recibidos</a> </li>
					</ul>
			
				<a href="#"><span style="padding-left:2em;"><i class="fa fa-exchange"></i></span><span style="padding-left:2em;">Transacciones</span></a>
					<ul>                         
							<li><a href="mis_pagos_realizados.php">Mis pagos realizados</a> </li>
                            <li><a href="mis_pagos_recibidos.php">Mis pagos recibidos</a> </li>
                            <li><a href="buscar_pagos.php">Transacciones por usuario</a></li>
							<li><a href="lista_transacciones.php?pg=1">Listado general</a></li>
					</ul>
									
				<a href="https://drive.google.com/folderview?id=0B78_lYDoEog3fmNiaE9Jc1ZGN3IyRVFpbzA5aVYtYWNWNUszejJtdEVJTDFOUmR6V3paa2c&usp=sharing"><span style="padding-left:2em;"><i class="fa fa-book"></i></span><span style="padding-left:2em;">Actas</span></a>
				
				<a href="#"><span style="padding-left:2em;"><i class="fa fa-signal"></i></span><span style="padding-left:2em;">Estadísticas</span></a>
					<ul>
                            <li><a href="balance2.php">Datos actuales</a></li>
                            <li><a href="evolucion2.php">Datos históricos</a></li>
  <!--                          <li><a href="historico.php">Ver histórico de pagos</a> </li>		-->
					</ul>
				<a href="agenda.php"><span style="padding-left:2em;"><i class="fa fa-calendar"></i></span><span style="padding-left:2em;">Agenda</span></a>
		</ul>		
	</li>
	<li>
		<a href="buscar_y_pagar.php"><i class="fa fa-gratipay"></i><span style="padding-left:2em;">Realizar Transferencia</span></a>
	</li>
	
	<li>
			<a href="tablon_anuncios.php"><i class="fa fa-file-text-o"></i><span style="padding-left:2em;">Tablón de Anuncios</span></a>
	</li>   
 
<!-- ****************************************************************************** -->              
    <li>
			<a href="#"><i class="fa fa-search"></i><span style="padding-left:2em;">Buscar</span></a>
			<ul>
					<li><a href="buscar_usuario.php">Usuari@</a></li>     
                    <li><a href="buscar_ofertas.php">Ofertas</a></li>		
			</ul>

	</li>
<li>
			<a href="#"><i class="fa fa-comments"></i><span style="padding-left:2em;">Foro</span></a>
			<ul>

                            <li><a href="ver_sugerencias.php?pg=1">Ver debates</a></li>     
                            <li><a href="insertar_sugerencia.php">Publicar tema nuevo</a></li>
							<li><a href="contactar.php?dest=admin">Escribir al administrador</a></li>
							<li><a href="contactar.php?dest=soporte">Escribir al soporte técnico</a></li>

			</ul>
</li>      
        
<li>
			<a href="fin_sesion.php"><i class="fa fa-sign-out"></i><span style="padding-left:2em;">Salir</span></a>
</li>  
  <!-- ****************************************************************************** -->              
</ul>
</div>
<br><p align="center"><b>Estás navegando como <?php echo $_SESSION['NOMBRE'] ;?></b></p>