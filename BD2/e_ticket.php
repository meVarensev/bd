<?
	require_once ('config.php');
	
	if ($_POST['sav'])
	{
		$ID_TICKET1=get_post('ID_TICKET1');
        $SEATS_NUMBER1=get_post('SEATS_NUMBER1');
		$E_MAIL1=get_post('E_MAIL1');
		$q1="update e_ticket set E_MAIL='".$E_MAIL1."' where ID_TICKET='".$ID_TICKET1."'";
		$q2="update e_ticket set SEATS_NUMBER='".$SEATS_NUMBER1."' where ID_TICKET='".$ID_TICKET1."'";
        
		echo($q1);
		mysql_query($q1);mysql_query($q2);
	}
	
	if ($_POST['add'] &&($_POST['idtrip1']!=''))
	{
		$E_MAILnew = get_post('E_MAILnew');
		$SNAME_PASnew = get_post('SNAME_PASnew');
		$SEATS_NUMBERnew = get_post('SEATS_NUMBERnew');
		$q = "insert into e_ticket(E_MAIL,SNAME_PAS,SEATS_NUMBER,ID_TRIP)
			value('" .$E_MAILnew. "','".$SNAME_PASnew."','".$SEATS_NUMBERnew."',$_POST[idtrip1])";
			echo $q;
		mysql_query($q);
	}
	
	if (($_POST['rad']) && ($_POST['del']))
	{
        $q="delete from e_ticket where ID_TICKET='".$_POST['rad']."'";
        mysql_query($q);
    }
	
	$query = "select *from (e_ticket join trip on trip.ID_TRIP = e_ticket.ID_TRIP) join route on trip.ID_ROUTE = route.ID_ROUTE";
	$result = mysql_query($query) or die ("Ошибка при выполении запроса: ".mysql_error());
	echo "<h2 align = center> Список билетов </h2>";
	
	echo "<form action='e_ticket.php' method='post'>";
		echo "<table border = 3 align = center>";
			 echo "<td>  </td>";
			 echo "<td> Адрес электронной почты </td>";
			 echo "<td> Фамилия пассажира </td>";
			 echo "<td> Количество забронированных мест </td>";
			 echo "<td> Номер рейса </td>";
			 echo "<td> Время отправления </td>";
			 echo "<td> Пункт отправления </td>";
			 echo "<td> Пункт прибытия </td>";
			 while( $row = mysql_fetch_array($result))
			 {
				echo "<tr>";
				echo "<td align = center><input type = radio name = 'rad' value='".$row["ID_TICKET"]."'</td>";
				echo "<td align = left>".$row["E_MAIL"]."</td>";
				echo "<td >".$row['SNAME_PAS']."</td>";
				echo "<td>".$row['SEATS_NUMBER']."</td>";
				echo "<td>".$row['ID_TRIP']."</td>";
				echo "<td>".$row['DEPARTURE_TIME']."</td>";
				echo "<td >".$row['POINT_1']."</td>";
				echo "<td >".$row['POINT_2']."</td>";
				echo "</tr>";
			 }
		echo "</table>";
		
		$result1=MYSQL_QUERY("select ID_TRIP,POINT_1,POINT_2,DEPARTURE_TIME,ARRIVAL_TIME from route join trip on trip.ID_ROUTE=route.ID_ROUTE ") or die ("Ошибка при выполнении запроса: ".mysql_error());
		/*$result2=MYSQL_QUERY("select ID_DRIVER,SNAME from driver_bus ") or die ("Ошибка при выполнении запроса: ".mysql_error());
		*/
		echo "<table border=0 width=30% align=center>";
		 echo "<tr></tr>";

		 echo "<tr><td><pre> Адрес электронной почты <input type=text name=E_MAILnew value=''>  </pre> </td>";
		 echo "<td><pre> Фамилия <input type=text name=SNAME_PASnew value=''>  </pre> </td>";
		 echo "<tr><td><pre> Количество мест <input type=int name=SEATS_NUMBERnew value=''>  </pre> </td>";
		 echo "<td><pre> Рейс ";
			 echo "<select name = idtrip1>";
			 while($row1 = mysql_fetch_array($result1))
		     {
				 echo "<option value = ".$row1['ID_TRIP'].">".$row1['POINT_1']."  -  ".$row1['POINT_2']." ".$row1['DEPARTURE_TIME']."  -  ".$row1['ARRIVAL_TIME']."</option>";
			 }			
			 echo "<\select></pre></td>";
			 echo "<tr></tr>";
		 echo "<tr></tr>";
			 
		
		 echo "<tr></tr>";
		 echo "<td><input type=submit name=add value='Добавить'></td>";
		 echo "<td> <input type=submit name=del value='Удалить'> </td>";
	
	
	
			 echo  " <td> <input type=submit name=upd value='Изменить'> </td>";
			 if (($_POST['rad']) && ($_POST['upd']))
			 {
				 $q="select * from e_ticket where ID_TICKET=".$_POST['rad'];
				 echo "<tr><td colspan=3 align=left>";
				 $res=mysql_query($q);
				 $row = mysql_fetch_array ($res);
				 echo "<pre> Изменение адреса электронной почты <input type=text name=E_MAIL1 value='".$row['E_MAIL']."'></pre>";
				 echo "<pre> Изменение количества забронированных мест <input type=int name=SEATS_NUMBER1 value='".$row['SEATS_NUMBER']."'></pre>";
				 echo "<input type=hidden name=ID_TICKET1 value='".$row['ID_TICKET']."'></td>";
				 echo "<td><input type=submit name=sav value='Сохранить'></td></tr>";
			 }
		 echo "</table>";
	echo"</form>";
	MYSQL_CLOSE(); 
	function get_post($var)
	{
		return mysql_real_escape_string($_POST[$var]);
	}
?>

<a href='zapros.php' target='_self'> Запросы</a>