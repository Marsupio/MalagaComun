<?php
//This page let an user edit a message
include('config.php');
if(isset($_GET['id'], $_GET['id2']))
{
	$id = intval($_GET['id']);
	$id2 = intval($_GET['id2']);
if(isset($_SESSION['username']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.authorid, t2.title, t.message, t.parent, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2="'.$id2.'" and t2.id="'.$id.'" and t2.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['userid']==$dn1['authorid'] or $_SESSION['username']==$admin)
{
include('bbcode_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Edit a reply - <?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
		<script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
        <div class="content">
<?php
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a>
        <a class="button" href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
    
	<div class="box_right">
    	<br />
    	<a class="button" href="list_pm.php">Tus Mensajes(<?php echo $nb_new_pm; ?>)</a>
        <a class="button" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="login.php">Salir</a>
    </div>
    
    <div class="clean">
    </div>
    
</div>
<?php
if(isset($_POST['message']) and $_POST['message']!='')
{
	if($id2==1)
	{
		if($_SESSION['username']==$admin and isset($_POST['title']) and $_POST['title']!='')
		{
			$title = $_POST['title'];
			if(get_magic_quotes_gpc())
			{
				$title = stripslashes($title);
			}
			$title = mysql_real_escape_string($dn1['title']);
		}
		else
		{
			$title = mysql_real_escape_string($dn1['title']);
		}
	}
	else
	{
		$title = '';
	}
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('update topics set title="'.$title.'", message="'.$message.'" where id="'.$id.'" and id2="'.$id2.'"'))
	{
	?>
	<div class="message">El mensaje ha sido correctamente editado.
    <br />
	<a class="button" href="read_topic.php?id=<?php echo $id; ?>">Volver al Tema</a>
    </div>
	<?php
	}
	else
	{
		echo 'Ocurrió un error mientras editaba el mensaje.';
	}
}
else
{
?>
<form action="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $id2; ?>" method="post">
<?php
if($_SESSION['username']==$admin and $id2==1)
{
?>
	<label for="title">Title</label><input type="text" name="title" id="title" value="<?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?>" />
<?php
}
?>
    <label id="texto_blanco" for="message">Edite la respuesta:</label>
    <br />
    <br />
    <!--
    <div class="message_buttons">
        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" />
        <input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" />
        <input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" />
        <input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" />
        <input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" />
        <input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" />
        <input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" />
        <input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    -->
    <textarea name="message" id="message" cols="70" rows="6"><?php echo html_to_bbcode($dn1['message']); ?></textarea>
    <br />
    <br />
    <input id="boton" type="submit" value="Modificar" />
</form>
<?php
}
?>
		</div>
		<?php include('pie_foro.php'); ?>

	</body>
</html>
<?php
}
else
{
	echo '<h2>No tiene el derecho de editar este mensaje.</h2>';
}
}
else
{
	echo '<h2>El mensaje que quiere editar no existe.</h2>';
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
}
else
{
	echo '<h2>El ID del mensaje que quiere editar no existe.</h2>';
}
?>