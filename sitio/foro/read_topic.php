<?php
//This page display a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, count(t2.id) as nb2, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2=1 and t2.id="'.$id.'" and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
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
        <a class="button" href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="button" href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a>
                   
    </div>
    
        
	<div class="box_right">
    <br />
    	<a class="button" href="list_pm.php">Tu Mensajes(<?php echo $nb_new_pm; ?>)</a>
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
        <a class="button" href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>  
        <a class="button" href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a>
        
    </div>
    
    
    <div class="clean">
    </div>
    
</div>

<?php
}
?>
<p id="texto_blanco"><?php echo $dn1['title']; ?></p>
<?php
if(isset($_SESSION['username']))
{
?>
	<br />
    <a class="button" href="new_reply.php?id=<?php echo $id; ?>">Contestar a este Tema</a>
    <br />
    <br />
<?php
}
$dn2 = mysql_query('select t.id2, t.authorid, t.message, t.timestamp, u.username as author, u.avatar from topics as t, users as u where t.id="'.$id.'" and u.id=t.authorid order by t.timestamp asc');
?>

<table class="messages_table">
	<tr>
    	<th class="author">Autor</th>
    	<th>Mensaje</th>
	</tr>
<?php
while($dnn2 = mysql_fetch_array($dn2))
{
?>
<tr>
<td class="author center">
<?php
/*
if($dnn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn2['avatar']).'" alt="Fotografía" style="max-width:100px;max-height:200px;" />';
}
*/
?>
<br />
<!--<a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo $dnn2['author']; ?></a>-->
<?php echo $dnn2['author']; ?>

</td>
    	
<td class="left"><?php if(isset($_SESSION['username']) and ($_SESSION['username']==$dnn2['author'] or $_SESSION['username']==$admin)){ ?>

<div class="edit">
<a href="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $dnn2['id2']; ?>">
<img src="images/edit2.png" alt="Edit" width="50" />
</a>
</div>

<?php } ?>

<div class="date">Escrito el <?php echo date('d/m/Y H:i:s' ,$dnn2['timestamp']); ?>
</div>

<br />
<div class="clean">
</div>
        
<?php echo $dnn2['message']; ?>
</td>
</tr>

<?php
}
?>
</table>
<?php
if(isset($_SESSION['username']))
{
?>
	<br />
	<p align="center"><a class="button" href="new_reply.php?id=<?php echo $id; ?>">Contestar a este tema</a></p>
<?php
}
else
{
?>
<!--
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
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
	echo '<h2>Este tema no existe.</h2>';
}
}
else
{
	echo '<h2>El ID de este tema no existe.</h2>';
}
?>