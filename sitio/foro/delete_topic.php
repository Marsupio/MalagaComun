<?php
//This page let delete a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['username']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['username']==$admin)
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Delete a topic - <?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
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
        <br />
        <br />
        <p id="texto_blanco">Borrar este Tema</p>
    </div>
    
	<div class="box_right">
    	<a class="button" href="list_pm.php">Tus mensajes(<?php echo $nb_new_pm; ?>)</a>
        <a class="button" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="login.php">Salir</a>
    </div>
    
    <div class="clean">
    </div>
    
</div>
<?php
if(isset($_POST['confirm']))
{
	if(mysql_query('delete from topics where id="'.$id.'"'))
	{
	?>
	<div class="message">El tema ha sido borrado.
    <br />
	<a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><br />
    Volver a <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>
    </a>
    </div>
	<?php
	}
	else
	{
		echo 'Ocurrió un error mientras se borraba el tema.';
	}
}
else
{
?>
<form action="delete_topic.php?id=<?php echo $id; ?>" method="post">
	<p id="texto_blanco" align="center">¿Está seguro que quiere borrar este tema?</p>
    <br />
    <input type="hidden" name="confirm" value="true" />
    <p align="center">
    <input id="boton" type="submit" value="Si" /> 
    <input id="boton" type="button" value="No" onclick="javascript:history.go(-1);" />
    </p>
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
	echo '<h2>No tiene los derechos para borrar este tema.</h2>';
}
}
else
{
	echo '<h2>El tema que quiere borrar no existe.</h2>';
}
}
else
{
	echo '<h2>Debe de entrar como administrador para ver esta página: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>El ID del tema que quiere borrar no existe.</h2>';
}
?>