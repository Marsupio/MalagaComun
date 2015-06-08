<?php
//This page let an user edit his profile
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Editar Perfil</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img id="imagen_cabecera" src="images/logo.jpg" alt="Espace Membre" /></a>
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
    </div>
    
	<div class="box_right">
    	<a class="button" href="list_pm.php">Mis Mensajes(<?php echo $nb_new_pm; ?>)</a>
        <a class="button" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="login.php">Salir</a>
    </div>
    
    <div class="clean">
    </div>
    
</div>
<?php
	if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
	{
		if(get_magic_quotes_gpc())
		{
			$_POST['username'] = stripslashes($_POST['username']);
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['avatar'] = stripslashes($_POST['avatar']);
		}
		if($_POST['password']==$_POST['passverif'])
		{
			if(strlen($_POST['password'])>=6)
			{
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string(sha1($_POST['password']));
					$email = mysql_real_escape_string($_POST['email']);
					$avatar = mysql_real_escape_string($_POST['avatar']);
					$dn = mysql_fetch_array(mysql_query('select count(*) as nb from users where username="'.$username.'"'));
					if($dn['nb']==0 or $_POST['username']==$_SESSION['username'])
					{
						if(mysql_query('update users set username="'.$username.'", password="'.$password.'", email="'.$email.'", avatar="'.$avatar.'" where id="'.mysql_real_escape_string($_SESSION['userid']).'"'))
						{
							$form = false;
							unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">Su perfil ha sido correctamente cambiado. De de iniciar de nuevo su sesión.
<br />
<br />
<a class="button" href="login.php">Iniciar Sesión</a>
</div>
<?php
						}
						else
						{
							$form = true;
							$message = '<p align="center" id="texto_blanco">Ha ocurrido un error mientras estaba cambiando sus datos.</p>';
						}
					}
					else
					{
						$form = true;
						$message = '<p align="center" id="texto_blanco">Otra persona ya tiene ese nombre de usuario.</p>';
					}
				}
				else
				{
					$form = true;
					$message = '<p align="center" id="texto_blanco">El email que ha escrito no es válido</p>';
				}
			}
			else
			{
				$form = true;
				$message = '<p align="center" id="texto_blanco">Su contraseña debe de tener como mínimo 6 letras y/o números.</p>';
			}
		}
		else
		{
			$form = true;
			$message = '<p align="center" id="texto_blanco">Las contraseñas que ha puesto no son iguales.</p>';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
		if(isset($_POST['username'],$_POST['password'],$_POST['email']))
		{
			$username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			$dnn = mysql_fetch_array(mysql_query('select username,email,avatar from users where username="'.$_SESSION['username'].'"'));
			$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
			$password = '';
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8');
		}
?>
    <form action="edit_profile.php" method="post">
    	<br />
        <p align="center" id="texto_blanco">Puede editar su información personal a continuación:</p>
        <br />
        <div class="center">
        
            <label for="username"><span id="texto_blanco">Nombre Usuario</span>
            </label><input type="text" name="username" id="username" value="<?php echo $username; ?>" />
            <br /><br />
            
            <label for="password">
            <span id="texto_blanco">Contraseña</span><br />
            <span class="small" id="texto_blanco">(minimo 6 caracteres)</span>
            </label><input type="password" name="password" id="password" value="<?php echo $password; ?>" />
            <br /><br />
            
            <label for="passverif">
            <span id="texto_blanco">Contraseña</span><br />
            <span class="small" id="texto_blanco">(verificación)</span>
            </label><input type="password" name="passverif" id="passverif" value="<?php echo $password; ?>" />
            <br /><br />
            
            <label for="email"><span id="texto_blanco">Email</span>
            </label><input type="text" name="email" id="email" value="<?php echo $email; ?>" />
            <br /><br />
            
            <label for="avatar"><span id="texto_blanco">Avatar</span><br />
            <span class="small" id="texto_blanco">(opcional)</span>
            </label><input type="text" name="avatar" id="avatar" value="<?php echo $avatar; ?>" />
            <br /><br />
            
            <input type="submit" value="Modificar mis datos" />
        </div>
    </form>

<?php
	}
}
else
{
?>

<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a>
    </div>
    
    
	<div class="clean">
    </div>
    
</div>

<p align="center" id="texto_blanco">Debe de estar registrado para acceder a esta página:</p>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Nombre Usuario</label><input type="text" name="username" id="username" /><br /><br />
		<label for="password">Contraseña</label><input type="password" name="password" id="password" /><br /><br />
<!--        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />-->

        <div class="center">
	        <input id="boton" type="submit" value="Iniciar Sesión" /> 
            <input id="boton" type="button" onclick="javascript:document.location='signup.php';" value="Darse de Alta" />
        </div>
        
    </form>
</div>
<?php
}
?>
		</div>
		
		<?php include('pie_foro.php'); ?>

                
	</body>
</html>