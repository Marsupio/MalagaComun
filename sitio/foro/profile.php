<?php
//This page display the profile of an user
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Perfil de usuario</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" /></a>
	    </div>
        <div class="content">
<?php
if(isset($_SESSION['username']))
{
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a>
        <a class="button" href="users.php">Lista de Usuarios registrados</a>
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
        <a class="button" href="users.php">Lista de usuarios</a>
    </div>
    
	<div class="box_right">
    	<a class="button" href="signup.php">Registrarse</a>
        <a class="button" href="login.php">Iniciar Sesión</a>
    </div>
    
    <div class="clean">
    </div>
    
</div>
<?php
}
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = mysql_query('select username, email, avatar, signup_date from users where id="'.$id.'"');
	if(mysql_num_rows($dn)>0)
	{
		$dnn = mysql_fetch_array($dn);
?>
<span id="texto_blanco">Este es el perfil de</span>
<span id="texto_blanco"><?php echo htmlentities($dnn['username']); ?>.</span>


<?php
if($_SESSION['userid']==$id)
{
?>

<br />
<div class="center"><a href="edit_profile.php" class="button">Editar mi Perfil</a>
</div>
<br />
<?php
}
?>
<table style="width:100%;">
<tr>
  	<td>
		
<?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:200px;" />';
}
else
{
	echo 'Sin foto para mostrar.';
}
?>
	</td>
    	<td class="left"><h2><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h2><br />
    	Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br /><br />
        Este usuario se unió al Foro el <?php echo date('Y/m/d',$dnn['signup_date']); ?><br />
    </td>
    </tr>
</table>

<?php
if(isset($_SESSION['username']) and $_SESSION['username']!=$dnn['username'])
{
?>
<br />
<p align="center">
<a class="button" href="new_pm.php?recip=<?php echo urlencode($dnn['username']); ?>">
Enviar un mensaje personal a "<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"
</a>
</p>
<?php
}
	}
	else
	{
		echo 'Este usuario no existe.';
	}
}
else
{
	echo 'El ID de este usuario no ha sido definido.';
}
?>
		</div>
			<?php include('pie_foro.php'); ?>
                
	</body>
</html>