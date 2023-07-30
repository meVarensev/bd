<?php
	include("config.php");
?>

<html>
<body style="background-image:url(../images/image3.jpg)">
<style>
body { background: url(../images/image3.jpg) no-repeat; }
 

   
   .table {
   
    margin: auto; /* Выравниваем таблицу по центру окна  */
   }
  

</style>
</body>
</html>

<!DOCTYPE html>
<html>

<body>
	<div class="exit">
		<a href="admin.php">Добавить/Изменить/Удалить</a></br>
		<a href="zaprosi.php">Запросы</a>
	</div>
	
<div>


		<?php
		echo'</br> <b><i><p align = "center">Всего клиентов:</p></b></i>';			
		$q=mysql_query("SELECT count(client.SureName) as aa FROM client",$db);
		while($res=mysql_fetch_array($q))
		{
			echo'
			<b><p align = "center">'.$res['aa'].' </p></b>';
		}	
		
		echo'</br> <b><i><p align = "center"> Всего потрачено денег: </p></b></i>';

	    $q=mysql_query("SELECT SUM(track.Price) as aa FROM track,client,buy WHERE client.NumCardClient=buy.NumCardClient && buy.IdTrack=track.IdTrack",$db);
		while($res=mysql_fetch_array($q))
		{
			echo'
			<b><p align = "center">'.$res['aa'].' </p></b>
				</br>';
		}
		
		echo'</br> <b><i><p align = "center"> Всего треков: </p></b></i>';
		$q=mysql_query("SELECT count(track.IdTrack) as aa FROM track",$db);
		while($res=mysql_fetch_array($q))
		{
			echo'
			<b><p align = "center">'.$res['aa'].' </p></b>
				</br>';
		}	
							
			//вывод таблицы buy
			$buy=mysql_query("SELECT * FROM buy,client,track WHERE buy.NumCardClient=client.NumCardClient && buy.IdTrack=track.IdTrack",$db);
			echo' <div class="">
			</br></br><strong>Cписок покупок: </strong></br></br>';
			echo"<TABLE border =1 table cellpadding=0 cellspacing=0 width = auto height = auto align=left><TR>
			<TH>Id Buy</TH><TH>Sure Name</TH><TH>First Name</TH><TH>Date</TH><TH>Time</TH><TH>Track Title</TH></TR>";
			while($res=mysql_fetch_array($buy))
			{
				echo"<TR><TD>$res[IdBuy]</TD><TD>$res[SureName]</TD><TD>$res[FirstName]</TD><TD>$res[Date]</TD><TD>$res[Time]</TD><TD>$res[tracktitle]</TD></TR>";
				//echo'
				//IdBuy - #'.$res['IdBuy'].'</br> Client Name - '.$res['SureName'].' '.$res['FirstName'].'</br> Date - '.$res['Date'].'</br> Time - '.$res['Time'].'</br> Track - '.$res['tracktitle'].'</br>
				//</br>------------------------------------</br>';
			}
			
			echo'</div>';
			echo'</table>';
			
			
			//вывод клиентов в таблице
			$client=mysql_query("SELECT * FROM client",$db);
			echo' <div class="table">
			<p align=center><strong>Список клиентов:</strong></p>';
			echo"<TABLE  border =1 table cellpadding=0 cellspacing=0 width=auto align=center><TR>
			<TH>Id Client</TH><TH>Sure Name</TH><TH>First Name</TH><TH>Card</TH></TR>";
			while($res=mysql_fetch_array($client))
			{
				echo"<TR><TD>$res[NumCardClient]</TD><TD>$res[SureName]</TD><TD>$res[FirstName]</TD><TD>$res[card]</TD></TR>";
				
			}
			echo'</div>';
			echo'</table>';
			
			//traki
			$track=mysql_query("SELECT * FROM track, performer, genre, album WHERE track.IdPerformer = performer.IdPerformer && track.IdGenre = genre.IdGenre && track.IdAlbum = album.IdAlbum",$db);
			echo' <div class="table">
			<p align=center><strong>Список треков:</strong></p>';
			echo"<TABLE  border =1 table cellpadding=0 cellspacing=0  align=center><TR>
			<TH>Id Track</TH><TH>Track Title</TH><TH>Name Performer</TH><TH>Nazvanie Album</TH><TH>Title Genre</TH><TH>Price</TH></TR>";
			while($res=mysql_fetch_array($track))
			{
				echo"<TR><TD>$res[IdTrack]</TD><TD>$res[tracktitle]</TD><TD>$res[name]</TD><TD>$res[nazvanie]</TD><TD>$res[title]</TD><TD>$res[Price]</TD></TR>";
				
			}
			echo'</div>';
			echo'</table>';
			?>
	</div>
</body>
</html>
