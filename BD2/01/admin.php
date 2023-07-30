<?php
	include("config.php");
	$page=$_GET['page'];
	if ($page=='' OR $page=='admin')
	{
?>

<html>
<body style="background-image:url(../images/image4.jpg)">
<style>
body { background: url(../images/image4.jpg) no-repeat; }
</style>
</body>
</html>

<!DOCTYPE html>
<html>
<body>
		<a href="index.php">Выход</a></br></br>
		<b>Клиент:</b>
		<ul>
			<li><a href="admin.php">Новый</a></li>
			<li><a href="?page=edit">Редактировать</a></li>		
			<li><a href="?page=delete">Удалить</a></li>
		</ul>
		<h1 align = center><strong>Создать </strong></h1></br>
	<div class="main">
		<form action="action/new_cl.php" method="post">
			Новый клиент</br>
			<input type="textbox" name = "SureName" required placeholder="SureName">
			<input type="textbox" name = "FirstName" required placeholder="FirstName">
			<input type="textbox" name = "card" required placeholder="card">
			<input type="submit" name = "submit" value="OK"></br>
		</form>
		<!--pokupka-->
		<form action="action/new_buy.php" method="post">
			Новая покупка</br>
			<?php
			echo '<select name="NumCardClient">';
			$q=mysql_query("SELECT * FROM client");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['NumCardClient'].'">'.$res['SureName'].' '.$res['FirstName'].'</option>';
			}
			echo'
			</select>';
			?>
			<input type="date" name = "Date" required placeholder="Date">
			<input type="time" name = "Time" required placeholder="Time">
			<?php
			echo '<select name="IdTrack">';
			$q=mysql_query("SELECT * FROM track");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['IdTrack'].'">'.$res['tracktitle'].' </option>';
			}
			echo'
			</select>';
			?>
			<input type="submit" name = "submit" value="OK"></br>
		</form>		
		
		<!--novi performer-->
		<form action="action/new_performer.php" method="post">
			Новый исполнитель</br>
			<?php
			echo '<select name="IdCountry">';
			$q=mysql_query("SELECT * FROM country");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['IdCountry'].'">'.$res['country'].'</option>';
			}
			echo'
			</select>';
			?>
		<input type="textbox" name = "name" required placeholder="name">
		
		<input type="submit" name = "submit" value="OK"></br>
		</form>		
			
			
		<!--novi track-->
		
		<form action="action/new_track.php" method="post">
			Новый трек</br>
			Исполнитель        Альбом             Жанр</br>
			<?php
			echo '<select name="IdPerformer">';
			$q=mysql_query("SELECT * FROM performer");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['IdPerformer'].'">'.$res['name'].'</option>';
			}
			echo'
			</select>';
			?>
						
			<?php
			echo '<select name="IdAlbum">';
			$q=mysql_query("SELECT * FROM album");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['IdAlbum'].'">'.$res['nazvanie'].'</option>';
			}
			echo'
			</select>';
			?>
			
			<?php
			echo '<select name="IdGenre">';
			$q=mysql_query("SELECT * FROM genre");
			while ($res=mysql_fetch_assoc($q))
			{
				echo'
				<option value="'.$res['IdGenre'].'">'.$res['title'].' </option>';
			}
			echo'
			</select>';
			?>
		<input type="textbox" name = "tracktitle" required placeholder="tracktitle">
		<input type="textbox" name = "Price" required placeholder="Price">
		
		<input type="submit" name = "submit" value="OK"></br>
		</form>		
		
	<!-- Edit -->			
<?php
	}
	else if ($page=='edit')
	{
?>

<html>
<body style="background-image:url(../images/image4.jpg)"> </body>
</html>

<!DOCTYPE html>
<html>
<body>
	<div class="exit">
		<a href="index.php">Выход</a></br>
	</div>

		<ul>
			<li><a href="admin.php">Новый</a></li>
			<li><a href="?page=edit">Редактировать</a></li>		
			<li><a href="?page=delete">Удалить</a></li>
		</ul>
		<h1 align = center><strong>Редактировать </strong></h1></br>
	<div class="main">
		<!-- edit client-->
		<?php
			echo'<h1 align = center><strong>Список клиентов: </strong></h1></br>';
			$q=mysql_query("SELECT * FROM client",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['SureName'].' '.$res['FirstName'].' '.$res['card'].'
				</br>
				<form action="action/edit_client_action.php?id='.$res['NumCardClient'].'" method="post">
				<input type="submit" name = "NumCardClient" value="'.$res['NumCardClient'].'">
				</form>
				';
			}
		?>
	
		
		
	</div>
</body>
</html>

<!-- Delete -->

<?php
	}
	else if ($page=='delete')
	{
?>

<html>
<body style="background-image:url(../images/image4.jpg)">

</body>
</html>

<!DOCTYPE html>
<html>
<body>
		<a href="index.php">Выход</a></br>
	<div class="nav">
		<ul>
			<li><a href="admin.php">Новый</a></li>
			<li><a href="?page=edit">Редактировать</a></li>		
			<li><a href="?page=delete">Удалить</a></li>
		</ul>
		<h1 align = center><strong>Удалить </strong></h1></br>
	</div>
	<div class="main">
	<!-- udalit client -->
	<?php
			echo'<h1 align = center><strong>Список клиентов: </strong></h1></br>';
			$q=mysql_query("SELECT * FROM Client",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['SureName'].' '.$res['FirstName'].' '.$res['card'].'
				</br>
				<form action="action/delete_client_action.php?id='.$res['NumCardClient'].'" method="post">
				<input type="submit" name = "NumCardClient" value="'.$res['NumCardClient'].'">
				</form>
				';
				
			}
				
		?>
		
		<!-- udalit track-->
		
		<?php
			echo'<h1 align = center><strong>Список треков: </strong></h1></br>';
			echo'<p>*Чтобы удалить трек, сначала нужно удалить его исполнителя, альбом, жанр</p></br>';
			$q=mysql_query("SELECT * FROM track",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['tracktitle'].' '.$res['Price'].' 
				</br>
				<form action="action/delete_track_action.php?id='.$res['IdTrack'].'" method="post">
				<input type="submit" name = "IdTrack" value="'.$res['IdTrack'].'">
				</form>
				';
				
			}	
		?>
		<!-- udalit pokupku-->
		
		<?php
			echo'<h1 align = center><strong>Список покупок: </strong></h1></br>';
			echo'<p>*Чтобы удалить покупку, сначала нужно удалить используемый трек, исполнителя,клиента</p></br>';
			$q=mysql_query("SELECT * FROM buy, client, track WHERE buy.NumCardClient = client.NumCardClient && buy.IdTrack = track.IdTrack",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['IdBuy'].' - '.$res['FirstName'].' '.$res['SureName'].' - '.$res['Date'].' '.$res['Time'].' '.$res['tracktitle'].' 
				</br>
				<form action="action/delete_buy_action.php?id='.$res['IdBuy'].'" method="post">
				<input type="submit" name = "IdBuy" value="'.$res['IdBuy'].'">
				</form>
				';
				
			}	
		?>
		
		<!-- udalit performer-->
			<?php
			echo'<h1 align = center><strong>Список исполнителей: </strong></h1></br>';
			echo'<p>*Чтобы удалить исполнителя, сначала нужно удалить его страну</p></br>';
			$q=mysql_query("SELECT * FROM performer, country WHERE performer.IdCountry = country.IdCountry",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['IdPerformer'].' - '.$res['name'].' - '.$res['country'].' 
				</br>
				<form action="action/delete_performer_action.php?id='.$res['IdPerformer'].'" method="post">
				<input type="submit" name = "IdPerformer" value="'.$res['IdPerformer'].'">
				</form>
				';
				
			}
		?>
		
		
		
		<!-- udalit country -->
	<?php
			echo'<h1 align = center><strong>Список стран: </strong></h1></br>';
			$q=mysql_query("SELECT * FROM country",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['IdCountry'].' '.$res['country'].' 
				</br>
				<form action="action/delete_country_action.php?id='.$res['IdCountry'].'" method="post">
				<input type="submit" name = "IdCountry" value="'.$res['IdCountry'].'">
				</form>
				';
				
			}
				
		?>
		
	</div>
</body>
</html>

<?php
	}
?>
