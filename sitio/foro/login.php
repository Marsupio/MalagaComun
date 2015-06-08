<?php
//This page let log in
include('config.php');
if(isset($_SESSION['username']))
{
	unset($_SESSION['username'], $_SESSION['userid']);
	setcookie('username', '', time()-100);
	setcookie('password', '', time()-100);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Iniciar Sesión</title>
    </head>
    <body>
    
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
        
	<div class="message"><p>Ha finalizado su sesión como usuario.</p>
    <br />
    <br />
	<a class="button" href="<?php echo $url_home; ?>">Inicio</a></div>
<?php
}
else
{
	$ousername = '';
	if(isset($_POST['username'], $_POST['password']))
	{
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
		}
		$req = mysql_query('select password,id from users where username="'.$username.'"');
		$dn = mysql_fetch_array($req);
		if($dn['password']==sha1($password) and mysql_num_rows($req)>0)
		{
			$form = false;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('username', $_POST['username'], $one_year);
				setcookie('password', sha1($password), $one_year);
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Iniciar Sesión</title>
    </head>
    <body>
    
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
        
<div class="message">
<p>Ha iniciado su sesión correctamente.<br />Ahora puede ver sus mensajes personales.</p>
<br />
<br />
<a class="button" href="<?php echo $url_home; ?>">Bienvenido al Foro de Málaga Común</a>
</div>

<?php
		}
		else
		{
			$form = true;
			$message = 'El nombre de usuario o la contraseña que introdució no son correctos.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Iniciar Sesión</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
<?php
if(isset($message))
{
	echo '<div class="message">'.$message.'</div>';
}
?>
<div class="content">

<?php
/*
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
*/
?>


<div class="box">

	<div class="box_left">
    
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a> 

        
    </div>
    
	<div class="box_right">
<!--    
    	<a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
-->
    </div>
    
    <div class="clean">
    </div>
    
</div>

    <form action="login.php" method="post">
    
        <p id="texto_blanco" align="center">Por favor, escribe tus datos para iniciar tu sesión:</p>
        <br /><br />
        
        <div class="login">
            <label for="username"> <span id="texto_blanco">Nombre Usuario</span> </label>
            <input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" />
            <br /><br />
            <label for="password"><span id="texto_blanco">Contraseña</span></label>
            <input  type="password" name="password" id="password" />
            <br /><br />
<!--            
<label for="memorize"><p id="texto_blanco">Recordarme</p></label><input type="checkbox" name="memorize" id="memorize" value="yes" />
-->
            <br /><br />
            <input id="boton" type="submit" value="Iniciar Sesión" />
		</div>
    </form>
    
</div>
<?php
	}
}
?>
			<?php include('pie_foro.php'); ?>

        
	</body>
</html>