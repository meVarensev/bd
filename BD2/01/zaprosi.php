<?php
	//http://test1.ru/zaprosi.php
	include("config.php");
	if ($_POST['z'])
	{
	$IdCountry=$_POST['IdCountry'];
	}
	//3na4enie prinimaetsya iz spiska
	
	if ($_POST['z1'])
	{
	$NumCardClient=$_POST['NumCardClient'];
	}
	
	if ($_POST['z2'])
	{
	$IdGenre=$_POST['IdGenre'];
	}
	
	if ($_POST['z3'])
	{
	$Date=$_POST['Date'];
	}
	
	if ($_POST['z4'])
	{
	$tracktitle=$_POST['tracktitle'];
	}

					
?>


<html>
<body style="background-image:url(../images/image2.jpg)">
<style>
body { background: url(../images/image2.jpg) no-repeat; }
</style>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
	<link rel='stylesheet' href='css/style.css'/>

<body>
	<div class="exit">
		<a href="admin.php">Admin</a></br>
		<a href="index.php">Main</a></br>
	</div>
	<?php
	
	
	//запрос - в какой стране какие треки
	//vot tut spisok dinami4eskiy
	$color = "olive";
     print "<p><font color='$color'><b>Выберите страну, чтобы узнать какие треки записаны в этой стране</br></b></font>";
	
	echo'<form action="zaprosi.php" method="post"><select name="IdCountry">';
		$query=mysql_query("SELECT * FROM country",$db);
			while ($result=mysql_fetch_assoc($query))
			{
				echo'
				<option value="'.$result['IdCountry'].'">'.$result['country'].'</option>';
			}
		echo'</select>
		';
		//vot tut spisok kon4ilsya
		echo' <input type="submit" name="z">
		</form>';
	$q=mysql_query("SELECT * FROM track,performer,country WHERE track.IdPerformer=performer.IdPerformer && performer.IdCountry=country.IdCountry && country.IdCountry='".$IdCountry."' ",$db);
		while($res=mysql_fetch_array($q))
		{
			echo'</br>
			Track: '.$res['tracktitle'].' - '.$res['country'].'.
				</br>';
		}
		
		//Кто какой трeк купил
		echo'</br><b>Выберите клиента, чтобы узнать какие треки он(она) купил(а)</br></br>';
		echo'<form action="zaprosi.php" method="post"> <select name="NumCardClient">';
		$query=mysql_query("SELECT * FROM client",$db);
			while ($result=mysql_fetch_assoc($query))
			{
				echo'
				<option value="'.$result['NumCardClient'].'">'.$result['SureName'].' '.$result['FirstName'].'</option>';
			}
		echo'</select>
		';
		//vot tut spisok kon4ilsya
		echo' <input type="submit" name="z1">
		</form>';
	$q=mysql_query("SELECT * FROM track,client,buy WHERE client.NumCardClient=buy.NumCardClient && buy.IdTrack=track.IdTrack && client.NumCardClient='".$NumCardClient."'",$db);
		while($res=mysql_fetch_array($q))
		{
			//echo'</br>
			//<i>'.$res['SureName'].' '.$res['FirstName'].'</i> bought <i>'.$res['tracktitle'].'</i>
			//	</br>';
			
			echo"<br>";
			echo"<i>".$res['SureName']."</i>"; echo" ";
			echo"<i>".$res['FirstName']."</i>"; echo" ";
			echo"bought"; echo" ";
			echo"<i>".$res['tracktitle']."</i>";
		}
				
		//Итого потрачено денег (SUM)
		 $color = "BB5578 ";
 
    print "<p><font color='$color'><b>Итого потрачено денег: </b></b></font>";
	//цветное
		
	$q=mysql_query("SELECT client.SureName, client.FirstName, client.NumCardClient, SUM(track.Price) as aa FROM track,client,buy WHERE client.NumCardClient=buy.NumCardClient && buy.IdTrack=track.IdTrack GROUP BY client.NumCardClient",$db);
		while($res=mysql_fetch_array($q))
		{
			echo'</br>
			'.$res['SureName'].' '.$res['FirstName'].' - <b>'.$res['aa'].' </b>
				</br>';
		}
		
		//В каком жанре какие треки
		$color = "AA8955";
    print "<p><font color='$color'><b>Выберите жанр, чтобы узнать какие треки есть в этом жанре: </b></b></font>";
		//echo'</br><b>Выберите жанр, чтобы узнать какие треки есть в этом жанре</b></br>';
		echo'<form action="zaprosi.php" method="post"> <select name="IdGenre">';
		$query=mysql_query("SELECT * FROM genre",$db);
			while ($result=mysql_fetch_assoc($query))
			{
				echo'
				<option value="'.$result['IdGenre'].'">'.$result['title'].'</option>';
			}
		echo'</select>
		';
		//vot tut spisok kon4ilsya
		echo' <input type="submit" name="z2">
		</form>';
	$q=mysql_query("SELECT * FROM track,genre,performer WHERE genre.IdGenre=track.IdGenre && track.IdPerformer=performer.IdPerformer && genre.IdGenre='".$IdGenre."'",$db);
		while($res=mysql_fetch_array($q))
		{
						
			echo"<br>";
			echo"in"; echo"    ";
			echo"Genre: "; echo" ";
			echo"<i>".$res['title']."</i>"; echo" ";
			
			echo"Track: "; echo" ";
			echo"<i>".$res['tracktitle']."</i>"; echo" ";
			echo"Performer: "; echo" ";
			echo"<i>".$res['name']."</i>";
		}
		
		//Какого числа какие покупки
		$color = "CC6678 ";
 
    print "<p><font color='$color'><b>Выберите дату, чтобы узнать какие были совершены покупки: </b></b></font>";
		//echo'</br><b>Выберите дату, чтобы узнать какие были совершены покупки</b></br>';
		echo'<form action="zaprosi.php" method="post"> <select name="Date">';
		$query=mysql_query("SELECT * FROM buy",$db);
			while ($result=mysql_fetch_assoc($query))
			{
				echo'
				<option value="'.$result['Date'].'">'.$result['Date'].'</option>';
			}
		echo'</select>
		';
		//vot tut spisok kon4ilsya
		echo' <input type="submit" name="z3">
		</form>';
	$q=mysql_query("SELECT * FROM track,client,buy WHERE buy.NumCardClient = client.NumCardClient && buy.IdTrack=track.IdTrack && buy.Date='".$Date."'",$db);
		while($res=mysql_fetch_array($q))
		{
			//echo'</br>
			//<i>'.$res['SureName'].' '.$res['FirstName'].'</i> bought <i>'.$res['tracktitle'].'</i>
			//	</br>';
			
			//echo"<br>";
			echo"in"; echo"    ";
			echo"Date: "; echo" ";
			echo$res['Date']; echo" ";
			echo"Track: "; echo" ";		
			echo"<i>".$res['tracktitle']."</i>"; echo" ";
			echo"Client: "; echo" ";
			echo"<i>".$res['SureName']."</i>";
		}
		
		//Трек и его данные
		//echo'</br></br><b>Выберите трек, чтобы узнать его данные</b></br>';
		$color = "FA1100 ";
 		print "<p><font color='$color'><b>Выберите трек, чтобы узнать его данные: </b></b></font>";
		echo'<form action="zaprosi.php" method="post"> <select name="tracktitle">';
		$query=mysql_query("SELECT * FROM track",$db);
			while ($result=mysql_fetch_assoc($query))
			{
				echo'
				<option value="'.$result['tracktitle'].'">'.$result['tracktitle'].'</option>';
			}
		echo'</select>
		';
		//vot tut spisok kon4ilsya
		echo' <input type="submit" name="z4">
		</form>';
	$q=mysql_query("SELECT * FROM track,performer,genre,album WHERE track.IdAlbum = album.IdAlbum && track.IdGenre=genre.IdGenre && track.IdPerformer=performer.IdPerformer && track.tracktitle='".$tracktitle."'",$db);
		while($res=mysql_fetch_array($q))
		{
			
			echo"Track: "; echo" ";
			echo$res['tracktitle']; echo" </br>";
			echo"Performer: "; echo" ";		
			echo"<i>".$res['name']."</i>"; echo" </br>";
			echo"Album: "; echo" ";
			echo"<i>".$res['nazvanie']."</i></br>";
			echo"Genre: "; echo" ";
			echo"<i>".$res['title']."</i></br>";
			echo"Price: "; echo" ";
			echo"<i>".$res['Price']."</i></br>";
		}
		
		//Средняя цена (AVG)
		$q2=mysql_query("SELECT AVG(Price) FROM track",$db);
		$res2=mysql_fetch_array($q2);
			//echo'</br>
			//echo"Средняя цена треков : "; echo" ";
			$color = "AB5678 ";
			print "<p><font color='$color'><b>Средняя цена треков: </b></b></font>";
			echo$res2[0]; 
			//</br>;
		
		//order by Фамилия
		$q3=mysql_query("SELECT client.SureName FROM client ORDER BY SureName",$db);
		$res3=mysql_fetch_array($q3);
			echo'</br>';
			echo'</br>';
			//echo"Sortirovka : "; echo" ";
			//echo$res3[0]; 

			$color = "AA9900";
 			print "<p><font color='$color'><b>Отсортируем фамилии клиентов по алфавиту: </b></font>";
			//echo'<b><i>Отсортируем фамилии клиентов по алфавиту: </i></b>'; echo" ";
			
			while($res3=mysql_fetch_array($q3)) 
			{
				echo'</br>';
				echo$res['NumCardClient']; 
				echo$res3[0];
							
				//echo$res3['FirstName'];
			}
			
		
		
		//ORDER BY Имя
		$q3=mysql_query("SELECT client.FirstName FROM client ORDER BY FirstName",$db);
		$res3=mysql_fetch_array($q3);
			echo'</br>';
			echo'</br>';
			
			$color = "AA9900";
 			print "<p><font color='$color'><b>Сортировка имени клиента по алфавиту: </b></font>";
			echo'</br>';
			while($res3=mysql_fetch_array($q3)) 
			{
			echo$res['NumCardClient']; 
			echo$res3[0]; 
			echo'</br>';
			}
			//Отсортировать клиентов по фамилии или имени (должен выбрать пользователь), вывести отсортированный список в виде полного имени клиентов
		
	?>
</body>
</html>