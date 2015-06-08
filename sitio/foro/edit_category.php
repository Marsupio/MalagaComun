<?php
//This page let an administrator edit a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysql_fetch_array(mysql_query('select count(id) as nb1, name, description from categories where id="'.$id.'" group by id'));
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
        <title>Edit a category - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
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
        <p id="texto_blanco">Edite la categoria.</p>
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
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	if(get_magic_quotes_gpc())
	{
		$name = stripslashes($name);
		$description = stripslashes($description);
	}
	$name = mysql_real_escape_string($name);
	$description = mysql_real_escape_string($description);
	if(mysql_query('update categories set name="'.$name.'", description="'.$description.'" where id="'.$id.'"'))
	{
	?>
	<div class="message">La categoría ha sido correctamente editada
    <br />
    <br />
	<a class="button" href="<?php echo $url_home; ?>">Ir al Indice</a></div>
	<?php
	}
	else
	{
		echo 'Ocurrió un error mientras editaba la categoría.';
	}
}
else
{
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post">

	<label for="name"><p id="texto_blanco">Nombre</p>
    </label><input type="text" name="name" id="name" value="<?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>" />
    <br /><br />
	<label for="description"><p id="texto_blanco">Descripción</label></p>
    <br />
    <textarea name="description" id="description" cols="70" rows="6"><?php echo htmlentities($dn1['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    <br /><br />
    <input id="boton" type="submit" value="Terminar" />
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
	echo '<h2>Debe de logearse como administrador para acceder a esta página: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>La categoria que quiere editar no existe.</h2>';
}
}
else
{
	echo '<h2>El ID de la categoria que quiere editar no existe.</h2>';
}
?>