<?php
//This page displays the list of the forum's categories
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>Forum</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>">
            <img id="imagen_cabecera" src="images/logo.jpg" alt="Forum" />
            </a>
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
    </div>
    
	<div class="box_right">
    	<a class="button" href="signup.php">Darse de Alta</a> - <a class="button" href="login.php">Entrar</a>
    </div>
    
	<div class="clean">
    </div>
    
</div>
<?php
}
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
	<a href="new_category.php" class="button">Nueva Categoría</a>
<?php
}
?>
<table class="categories_table">
	<tr>
    	<th class="forum_cat">Categoría</th>
    	<th class="forum_ntop">Asuntos</th>
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
$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysql_num_rows($dn1);
while($dnn1 = mysql_fetch_array($dn1))
{
?>
	<tr>
    	<td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="description"><?php echo $dnn1['description']; ?></div></td>
    	<td><?php echo $dnn1['topics']; ?></td>
    	<td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    	<td>
        <a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><img src="images/delete.png" alt="Delete"  /></a>
		<?php if($dnn1['position']>1){ ?>
        <a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="images/up.png" alt="Move Up" /></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?>
        <a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="images/down.png" alt="Move Down" /></a>
		<?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><img src="images/edit.png" alt="Edit" /></a>
        </td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
	<a href="new_category.php" class="button">Nueva Categoría</a>
<?php
}
if(!isset($_SESSION['username']))
{
?>
<!--
<div class="box_login">
	<form action="login.php" method="post">
    
		<label for="username">Usuario</label><input type="text" name="username" id="username" /><br /><br />
		<label for="password">Contraseña</label><input type="password" name="password" id="password" /><br /><br />
        <label for="memorize">Recúerdame</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />

        <div class="center">
        <br />
		<input type="submit" value="Entrar" /> 
        <input type="button" onclick="javascript:document.location='signup.php';" value="Darme de Alta" />

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
