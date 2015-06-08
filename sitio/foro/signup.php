<?php
//This page let users sign up
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Darse de alta</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>">
            <img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" width="100%" height="10%" />
            </a>
	    </div>
<?php
if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
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
				$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				if($dn==0)
				{
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;
					if(mysql_query('insert into users(id, username, password, email, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
					{
						$form = false;
?>
<div class="message">

<p >
Se ha registrado correctamente.<br />Ahora puede entrar introduciendo su nombre de usuario y contraseña en el menu principal. 
</p>

<br />

<a class="button" href="index.php">Entrar</a>

</div>

<?php
					}
					else
					{
						$form = true;
						$message = 'Ocurrió un error cuando se estaba registrando.';
					}
				}
				else
				{
					$form = true;
					$message = 'Otra persona ya tiene ese nombre de usuario.';
				}
			}
			else
			{
				$form = true;
				$message = 'El email que ha escrito no es válido.';
			}
		}
		else
		{
			$form = true;
			$message = 'Su contraseña debe de tener como mínimo 6 letras y/o números.';
		}
	}
	else
	{
		$form = true;
		$message = 'Las contraseñas que introdució no son iguales.';
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
		echo '<div class="message">'.$message.'</div>';
	}
?>
<div class="content">
<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a> 
    </div>
    
	<div class="box_right">
 <!--   	<a class="button" href="signup.php">Darse de Alta</a> - <a class="button" href="login.php">Entrar</a> -->
    </div>
    
    <div class="clean"></div>
</div>

	<center>
    <form action="signup.php" method="post"> <span style="color:#fff">Por favor, rellene los datos para darse de alta en el foro:</span><br /><br />
        
        <div class="center">
        
            <label for="username"><span style="color:#fff">Nombre Usuario</span></label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" />
            <br />
            <br />
            
            <label for="password"><span style="color:#fff">Contraseña</span><span class="small" style="color:#fff"><br />(MINIMO 6 CARACTERES.)</span></label><input type="password" name="password" />
            <br />
            <br />
            
            <label for="passverif"><span style="color:#fff">Verificar Contraseña</span><span class="small" style="color:#fff"><br />(VERIFICACIÓN)</span></label><input type="password" name="passverif" />
            <br />
            <br />
            
            <label for="email"><span style="color:#fff">Email</span></label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" />
            <br />
            <br />
            
            <label for="avatar"><span style="color:#fff">Apodo o Avatar</span><span class="small" style="color:#fff"><br />(OPCIONAL)</span></label><input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br /><br />
            
            <input id="boton" type="submit" value="Darse de Alta" />
            
		</div>
    </form>
    </center>
    
</div>
<?php
}
?>
			<?php include('pie_foro.php'); ?>

        
	</body>
</html>