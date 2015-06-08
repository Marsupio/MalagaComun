<?php
//This page let delete a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysql_fetch_array(mysql_query('select count(id) as nb1, name, position from categories where id="'.$id.'" group by id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Borrar una categoria - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
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
        <br />
        <br />
		<p id="texto_blanco"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></p>
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
if(isset($_POST['confirm']))
{
	if(mysql_query('delete from categories where id="'.$id.'"') and mysql_query('delete from topics where parent="'.$id.'"') and mysql_query('update categories set position=position-1 where position>"'.$dn1['position'].'"'))
	{
	?>
	<div class="message">La Categoría y sus temas asociados han sido borrados.
    <br />
    <br />
	<a class="button" href="<?php echo $url_home; ?>">Ir al Indice</a></div>
	<?php
	}
	else
	{
		echo 'Ocurrió un error mientras se estaba borrando la categoría.';
	}
}
else
{
?>
<form action="delete_category.php?id=<?php echo $id; ?>" method="post">
<p id="texto_blanco" align="center">¿Está seguro que desea borrar esta categoría y todos sus temas y respuestas asociadas?</p>
<br />
    <input type="hidden" name="confirm" value="true" />
    <p align="center">
    <input id="boton" type="submit" value="Yes" />
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
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>>La categoria que quiere borrar no existe.</h2>';
}
}
else
{
	echo '<h2>El ID de la categoria que quiere borrar no existe.</h2>';
}
?>