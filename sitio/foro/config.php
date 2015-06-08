<?php

//We log to the DataBase

mysql_connect('localhost', 'root', '');

mysql_select_db('foro');

//Username of the Administrator
$admin='admin';

//Forum Home Page
$url_home = 'index.php';

//Design Name
$design = 'default';


// inicializacion 
include('init.php');
?>