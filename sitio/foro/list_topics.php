<?php
//This page let display the list of topics of a category
include('config.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	$dn1 = mysql_fetch_array(mysql_query('select count(c.id) as nb1, c.name,count(t.id) as topics from categories as c left join topics as t on t.parent="'.$id.'" where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>">
            <img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" width="100%" height="10%" />
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
        <a class="button" href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
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
}
else
{
?>
<div class="box">

	<div class="box_left">
    	<a class="button" href="<?php echo $url_home; ?>">Indice</a> 
        <a class="button" href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
<!--    
	<div class="box_right">
    	<a class="button" href="signup.php">Darse de Alta</a>
        <a class="button" href="login.php">Entrar</a>
    </div>
-->    
	<div class="clean">
    </div>
    
</div>
<?php
}
if(isset($_SESSION['username']))
{
?>
	<p align="center"><a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Nuevo Tema</a></p>
<?php
}
$dn2 = mysql_query('select t.id, t.title, t.authorid, u.username as author, count(r.id) as replies from topics as t left join topics as r on r.parent="'.$id.'" and r.id=t.id and r.id2!=1  left join users as u on u.id=t.authorid where t.parent="'.$id.'" and t.id2=1 group by t.id order by t.timestamp2 desc');
if(mysql_num_rows($dn2)>0)
{
?>
<table class="topics_table">
	<tr>
    	<th class="forum_tops">Tema</th>
    	<th class="forum_auth">Autor</th>
    	<th class="forum_nrep">Respuestas</th>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    	<th class="forum_act">Acción</th>
<?php
}
?>
	</tr>
<?php
while($dnn2 = mysql_fetch_array($dn2))
{
?>
	<tr>
    	<td class="forum_tops">
        <a href="read_topic.php?id=<?php echo $dnn2['id']; ?>"><?php echo htmlentities($dnn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td>
        <a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo htmlentities($dnn2['author'], ENT_QUOTES, 'UTF-8'); ?></a>
        </td>
    	<td><?php echo $dnn2['replies']; ?>
        </td>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    	<td><a href="delete_topic.php?id=<?php echo $dnn2['id']; ?>"><img src="images/delete.png" alt="Delete" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<div class="message">Esta categoría no tiene temas.</div>
<?php
}
if(isset($_SESSION['username']))
{
?>
	<br />
	<p align="center"><a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Nuevo Tema</a></p>
    <br />
<?php
}
else
{
?>
<!--
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Usuario</label><input type="text" name="username" id="username" /><br /><br />
		<label for="password">Contraseña</label><input type="password" name="password" id="password" /><br /><br />
        <label for="memorize">Recuerdame</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
        <div class="center">
        	<br />
	        <input type="submit" value="Entrar" /> 
            <input type="button" onclick="javascript:document.location='signup.php';" value="Darse de Alta" />
        </div>
    </form>
</div>
-->
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
	echo '<h2>This category doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to visit is not defined.</h2>';
}
?>