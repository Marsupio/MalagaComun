<?php
//This page let reply to a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['username']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Add a reply - <?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
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
	include('bbcode_function.php');
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$dn1['parent'].'", "'.$id.'", max(id2)+1, "", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics where id="'.$id.'"') and mysql_query('update topics set timestamp2="'.time().'" where id="'.$id.'" and id2=1'))
	{
	?>
	<div class="message">Su contestación ha sido publicada.
    <br />
    <br />
	<a class="button" href="read_topic.php?id=<?php echo $id; ?>">Ir al Tema</a></div>
	<?php
	}
	else
	{
		echo 'Ocurrió un error mientras se enviaba su mensaje.';
	}
}
else
{
?>
<form action="new_reply.php?id=<?php echo $id; ?>" method="post">
    <label id="texto_blanco" for="message">Mensaje</label>
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
    <textarea name="message" id="message" cols="70" rows="6"></textarea>
    <br />
    <br />
    <input id="boton" type="submit" value="Enviar" />
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
	echo '<p>El tema al que quiere contestar no existe.</p>';
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
	echo '<p>El ID del tema al que quiere contestar no existe.</p>';
}
?>