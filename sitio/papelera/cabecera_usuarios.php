<?php include ("seguridad.php"); ?>

<!DOCTYPE HTML>
<html lang="es">
<head>
		<title>Málaga Común</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />            
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
</head>
<body>


<!-- ******************  Ventana modal en si   **************************************-->
<script type="text/javascript" src="js/ventana_modal.js"></script>
<link rel="stylesheet" href="css/estilo_ventana_modal.css" /> 

<div id="bg_ventana_modal">

<div id="ventana_modal">

  <div id="controles_ventana_modal_superior_derecha">
        <a onclick="VentanaModal('hidden','')"><img  id="boton_cerrar" src="imagenes/boton_cerrar.png" alt="" /></a>
   </div>   

</div> 

</div>
<!-- ***********************fin ventana modal    ******************************-->


<!-- Header -->
<div id="header" class="skel-panels-fixed">
		<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="../images/avatar.png" alt="" /></span>
							<h1 id="title">Málaga Común</h1>
							<span class="byline">Sistema de Moneda Social</span>
						</div>
                
                <!-- Nav -->
                <nav id="nav">
                    <?php include ('menu_usuarios.php'); ?>
                </nav>
                    
		</div> <!-- top -->		
</div> <!-- header -->


<!-- Main -->
<div id="main">
    
<?php include ('menu_horizontal.php'); ?>
            
<section >
<div class="container">
