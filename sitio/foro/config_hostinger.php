<?php

//We log to the DataBase

mysql_connect('mysql.hostinger.es', 'u435363569_foro', 'clave7788');

mysql_select_db('u435363569_foro');

//Username of the Administrator
$admin='admin';

//Forum Home Page
$url_home = 'index.php';

//Design Name
$design = 'default';


// inicializacion 
include('init.php');
?>