//admin, udalit
<!-- udalit album-->
		<?php
			echo'<h1 align = center><strong>������ ��������: </strong></h1></br>';
			//echo'<p>*����� ������� ����, ������� ����� ������� ��� �����������, ������, ����</p></br>';
			$q=mysql_query("SELECT * FROM album",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				 '.$res['IdAlbum'].' '.$res['nazvanie'].'
				</br>
				<form action="action/delete_album_action.php?id='.$res['IdAlbum '].'" method="post">
				<input type="submit" name = "IdAlbum " value="'.$res['IdAlbum '].'">
				</form>
				';
				
			}

		?>
//admin, edit	
		<!-- edit performer-->
		<?php
			echo'<h1 align = center><strong>������ ������������: </strong></h1></br>';
			$q=mysql_query("SELECT * FROM performer, country WHERE performer.IdCountry = country.IdCountry",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['IdPerformer'].' - '.$res['name'].' - '.$res['country'].' 
				</br>
				<form action="action/edit_performer_action.php?id='.$res['IdBuy'].'" method="post">
				<input type="submit" name = "IdPerformer" value="'.$res['IdPerformer'].'">
				</form>
				';
			}
		?>
		
			
		<!-- edit buy-->
		
		<?php
			echo'<h1 align = center><strong>������ �������: </strong></h1></br>';
			$q=mysql_query("SELECT * FROM buy, client, track WHERE buy.NumCardClient = client.NumCardClient && buy.IdTrack = track.IdTrack",$db);
			while ($res=mysql_fetch_array($q))
			{
				echo'
				'.$res['SureName'].' '.$res['FirstName'].' '.$res['Date'].' '.$res['Time'].' '.$res['tracktitle'].'
				</br>
				<form action="action/edit_buy_action.php?id='.$res['IdBuy'].'" method="post">
				<input type="submit" name = "IdBuy" value="'.$res['IdBuy'].'">
				</form>
				';
			}
		?>
		
		