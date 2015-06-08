<?php
//This page display a personnal message
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Read a PM</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
<?php
if(isset($_SESSION['username']))
{
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
if(mysql_num_rows($req1)==1)
{
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
if($dn1['user1']==$_SESSION['userid'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
$req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, users.username, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Su respuesta ha sido enviada.
<br />
<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Ir a mensajes personales</a>
</div>
<?php
	}
	else
	{
?>
<div class="message">Ocurrió un error mientras enviaba su respuesta.
<br />
<a class="button" href="read_pm.php?id=<?php echo $id; ?>">Ir a mensajes personales</a>
</div>
<?php
	}
}
else
{
?>
<div class="content">
<?php
if(isset($_SESSION['username']))
{
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Inicio</a>
        <a class="button" href="list_pm.php">Lista de tus mensajes</a>
    </div>
    
	<div class="box_right">
    	<a class="button" href="list_pm.php">Tus Mensajes(<?php echo $nb_new_pm; ?>)</a>
        <a class="button" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="login.php">Salir</a>
        
    </div>
    
    <div class="clean">
    </div>
    
</div>
<?php
}
else
{
?>
<div class="box">
	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a>
        <a class="button" href="list_pm.php">Lista de tus mensajes personales</a> &gt; Read a PM
    </div>
	<div class="box_right">
    	<a class="button" href="signup.php">Darse de alta</a>
        <a class="button" href="login.php">Entrar</a>
    </div>
    <div class="clean">
    </div>
</div>
<?php
}
?>
<p id="texto_blanco"><?php echo $dn1['title']; ?></p>
<table class="messages_table">
	<tr>
    	<th class="author">Usuario</th>
        <th>Mensaje</th>
    </tr>
<?php
while($dn2 = mysql_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center">
<?php
/*
if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
*/
?>
<br />
<a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
    	<td class="left"><div class="date">Enviado el <?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
?>
</table>
<br />
<div class="center">
    <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center"><p align="center" id="texto_blanco">Mensaje de Respuesta</p></label>
        <br />
        <br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea>
        <br />
        <br />
        <input id="boton" type="submit" value="Enviar" />
    </form>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">No tiene permiso para acceder a esta página</div>';
}
}
else
{
	echo '<div class="message">Este mensaje no existe.</div>';
}
}
else
{
	echo '<div class="message">El ID de este mensaje no existe.</div>';
}
}
else
{
?>
<h2>Debe de estar registrado para acceder a esta página.</h2>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Nombre Usuario</label><input type="text" name="username" id="username" />
        <br /><br />
		<label for="password">Contraseña</label><input type="password" name="password" id="password" />
        <br /><br />
       <!-- <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />-->
        <div class="center">
	        <input id="boton" type="submit" value="Entrar" /> 
            <input id="boton" type="button" onclick="javascript:document.location='signup.php';" value="Darse de Alta" />
        </div>
    </form>
</div>
<?php
}
?>
					<?php include('pie_foro.php'); ?>

	</body>
</html>