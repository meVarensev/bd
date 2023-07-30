<?
	require_once ('config.php');
	
	if ($_POST['sav'])
	{
		$ID_TRIP1=get_post('ID_TRIP1');
        $DEPARTURE_TIME1=get_post('DEPARTURE_TIME1');
        $ARRIVAL_TIME1=get_post('ARRIVAL_TIME1');
		$q1="update trip set DEPARTURE_TIME='".$DEPARTURE_TIME1."' where ID_TRIP='".$ID_TRIP1."'";
		$q2="update trip set ARRIVAL_TIME='".$ARRIVAL_TIME1."' where ID_TRIP='".$ID_TRIP1."'";
        mysql_query($q1);mysql_query($q2);
	}
	
	if ($_POST['sav']) 
{ 
$IDZ1=get_post('IDZ1'); 
$ARDATE1=get_post('ARDATE1'); 
$DEPDATE1=get_post('DEPDATE1'); 

$q1="update zakaz set ArDate='".$ARDATE1."' where IDZ='".$IDZ1."'";
$q2="update zakaz set DerDate='".$DEPDATE1."' where IDZ='".$IDZ1."'"; 

echo($q1); 
echo($q2); 

mysql_query($q1); 
mysql_query($q2); 
} 
	
	
	if ($_POST['add'] &&($_POST['idroute1']!=''))
	{
		$DEPARTURE_TIMEnew = get_post('DEPARTURE_TIMEnew');
		$ARRIVAL_TIMEnew = get_post('ARRIVAL_TIMEnew');
		$q = "insert into trip(DEPARTURE_TIME,ARRIVAL_TIME,ID_DRIVER,ID_ROUTE)
			value('" .$DEPARTURE_TIMEnew. "','".$ARRIVAL_TIMEnew."',$_POST[id_driver1],$_POST[idroute1])";
			echo $q;
		mysql_query($q);
	}
	
	if (($_POST['rad']) && ($_POST['del']))
	{
        $q="delete from trip where ID_TRIP='".$_POST['rad']."'";
        mysql_query($q);
    }
	
	$query = "select * from trip join driver_bus on trip.ID_DRIVER = driver_bus.ID_DRIVER join route on trip.ID_ROUTE = route.ID_ROUTE";
	$result = mysql_query($query) or die ("Ошибка при выполении запроса: ".mysql_error());
	echo "<h2 align = center> Расписание автобусов </h2>";
	
	echo "<form action='trip.php' method='post'>";
		echo "<table border = 3 align = center>";
			 while( $row = mysql_fetch_array($result))
			 {
				echo "<tr>";
				echo "<td align = center><input type = radio name = 'rad' value='".$row["ID_TRIP"]."'</td>";
				echo "<td align = left>".$row["POINT_1"]."</td>";
				echo "<td >".$row['POINT_2']."</td>";
				echo "<td>".$row["DEPARTURE_TIME"]."</td>";
				echo "<td >".$row['ARRIVAL_TIME']."</td>";
				echo "<td >".$row['SNAME']."</td>";
				echo "<td >".$row['GOS_NUMBER']."</td>";
				echo "</tr>";
			 }
		echo "</table>";
		
		$result1=MYSQL_QUERY("select ID_ROUTE,POINT_1,POINT_2 from route ") or die ("Ошибка при выполнении запроса: ".mysql_error());
		$result2=MYSQL_QUERY("select ID_DRIVER,SNAME from driver_bus ") or die ("Ошибка при выполнении запроса: ".mysql_error());
		
		echo "<table border=0 width=30% align=center>";
			 echo "<tr></tr>";

			 echo "<td><pre> Маршрут ";
			 echo "<select name = idroute1>";
			 while($row1 = mysql_fetch_array($result1))
		     {
				 echo "<option value = ".$row1['ID_ROUTE'].">".$row1['POINT_1']."  -  ".$row1['POINT_2']."</option>";
			 }			
			 echo "<\select></pre></td>";
			 echo "<tr></tr>";
			 
			 echo "<td><pre> Водитель ";
			 echo "<select name = id_driver1>";
			 while($row2 = mysql_fetch_array($result2))
		     {
				 echo "<option value = ".$row2['ID_DRIVER'].">".$row2['SNAME']."</option>";
			 }			
			 echo "<\select></pre></td>";
			 
			 echo "<td><pre> Время отправления <input type = time name = DEPARTURE_TIMEnew value = ''></pre></td>";
			 echo "<td><pre> Время прибытия <input type = time name = ARRIVAL_TIMEnew value = ''></pre></td>";
			 
			 echo "<tr></tr>";
			 echo "<td><input type=submit name=add value='Добавить'></td>";
			 echo "<td> <input type=submit name=del value='Удалить'> </td>";
	
	
	
			 echo  " <td> <input type=submit name=upd value='Изменить'> </td>";
			 if (($_POST['rad']) && ($_POST['upd']))
			 {
				 $q="select * from trip where ID_TRIP=".$_POST['rad'];
				 echo "<tr><td colspan=3 align=left>";
				 $res=mysql_query($q);
				 $row = mysql_fetch_array ($res);
				 echo "<pre>Новое время отправления<input type=text name=DEPARTURE_TIME1 value='".$row['DEPARTURE_TIME']."'></pre>";
				 echo "<pre>Новое время прибытия <input type=text name=ARRIVAL_TIME1 value='".$row['ARRIVAL_TIME']."'></pre>";
				 echo "<input type=hidden name=ID_TRIP1 value='".$row['ID_TRIP']."'></td>";
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


<pre>
          Для добавления нового рейса в бд:             <i> Выбрать маршрут, ввести время отправления/прибытии <b>Добавить</b> </i>
          Для удаления рейса из базы данных:            <i> Выбрать соответствующую строку и </i><b>Удалить</b>
          Для исправления времени отправления/прибытия: <i> Выбрать соответствующую строку и </i><b>Изменить</b>
</pre>


<a href='zapros.php' target='_self'> Запросы</a>