<?php
//This page let create a new personnal message
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Nuevo mensaje personal</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
<?php
if(isset($_SESSION['username']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where username="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			if($dn1['recipid']!=$_SESSION['userid'])
			{
				$id = $dn1['npm']+1;
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
	?>
	<div class="message">Su mensaje ha sido correctamente enviado.
    <br />
    <br />
	<a class="button" href="list_pm.php">Listado de tus mensajes personales</a></div>
	<?php
					$form = false;
				}
				else
				{
					$error = 'Ocurrió un error mientras se enviaba el mensaje.';
				}
			}
			else
			{
				$error = 'No puedes mandarte un mensaje a tí mismo.';
			}
		}
		else
		{
			$error = 'No existe el usuario de destion del mensaje';
		}
	}
	else
	{
		$error = 'Uno de los campos no ha sido rellenado.';
	}
}
elseif(isset($_GET['recip']))
{
	$orecip = $_GET['recip'];
}
if($form)
{
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
?>
<div class="content">
<?php
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<div class="box">
	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a>
        <a class="button" href="list_pm.php">Mensajes</a>
    </div>
    
	<div class="box_right">
     	<a class="button" href="list_pm.php">Tus mensajes(<?php echo $nb_new_pm; ?>)</a>
        <a class="button" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="login.php">Salir</a>
    </div>
    
    <div class="clean">
    </div>
    
</div>
	<p align="center" id="texto_blanco"><b>Nuevo mensaje personal a un usuario</b></p>
    <br />
    <form action="new_pm.php" method="post">
		<p align="center" id="texto_blanco">Por favor, rellene los siguente datos para mandar el mensaje:</p>
        <br />
        
        <label for="title"><span id="texto_blanco">Título</span>
        </label>
        <input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" />
        <br /><br />
        
        <label for="recip"><p id="texto_blanco">Usuario Destino</p>
        <span id="texto_blanco" class="small">(Nombre de Usuario)</span>
        </label>
        <input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" />
        <br /><br />
        
        <label for="message"><p id="texto_blanco">Mensaje</p>
        </label>
        <textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea>
        <br /><br />
        
        <p align="center"><input id="boton" type="submit" value="Enviar mensaje" /></p>
    </form>
</div>
<?php
}
}
else
{
?>
<div class="message">You must be logged to access this page.</div>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
?>
			<?php include('pie_foro.php'); ?>

                
	</body>
</html>