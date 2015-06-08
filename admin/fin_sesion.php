<?php
session_start(); 

session_unset(); // eliminar las variables de sesión
session_destroy(); 

header("Location: ../index.php"); 


?> 
