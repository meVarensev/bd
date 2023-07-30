<?
	require_once('config.php');
	
	if ($_POST['do'])
	{
		$zapros=get_post('zapros'.$_POST['rad']);
           $p=get_post('p'.$_POST['rad']);
           $par=get_post('par'.$_POST['rad']);
           if ($p)
           {
             $zapros=$zapros.$par."'".$p."'";
           }
		      
		   
           $res=mysql_query($zapros);
           $kol_strok=mysql_num_rows($res);//возвращает количество рядов результата запроса
		   $kol_poley=mysql_num_fields($res);// возвращает количество полей результата запроса
            echo "<table border='2' align=center width=50%>";
			echo "<tr><td colspan='".$kol_poley."'><b><i>".$zapros."</i></b></td></tr>";
			for($i=0; $i<$kol_strok; $i++)	
			{
             	 $row=mysql_fetch_row($res);
            	 echo "<tr>";
             	 for ($j=0; $j<$kol_poley; $j++)
               	 echo "<td>".$row[$j]."</td>";
             	 echo "</tr>";
            }
        echo "</table>";
	}

	
	echo "<form method='post' action='zapros.php'>";
		echo "<br></br><br></br>";
		echo " <table width = 60% align = center>";

			echo "<tr><th colspan='3'>Запросы </th></tr>";
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '1'></td>";
			echo "<td width = 80%> 1. Для каждого водителя вывести маршрут, по котрому он работает сегодня</td>";
			echo "<input type=hidden name='zapros1'  value='select SNAME, FNAME, POINT_1,POINT_2 from driver_bus join (trip join route on trip.ID_ROUTE = route.ID_ROUTE)on driver_bus.ID_DRIVER= trip.ID_DRIVER'>";
			echo "</tr>";
			
			
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '2'></td>";
			echo "<td width = 80%> 2. Вывести данные тех водителей, чей стаж работы больше среднего стажа всех водителей</td>";
			echo "<input type=hidden name='zapros2'  value='select *from driver_bus where EXPERIENCE> (select AVG(EXPERIENCE) from driver_bus)'>";
			echo "</tr>";

			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '3'></td>";
			echo "<td width = 50% align = left> 3. Вывести маршруты, длина которых больше  ";
			echo "<input type=text name='p3' size='1' value=''>  километров  </td>";
			echo "<input type=hidden name='zapros3'  value='select POINT_1,POINT_2, DISTANCE from route'>";
              			echo "<input type=hidden name='par3'  value=' where DISTANCE >'>";
			echo "</tr>";
			
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '4'></td>";
			echo "<td width = 80%> 4. Посчитать количество рейсов по каждому маршруту </td>";
			echo "<input type=hidden name='zapros4'  value='select POINT_1, POINT_2,COUNT(*) from trip join route on route.ID_ROUTE = trip.ID_ROUTE group by POINT_1,POINT_2 '>";
			echo "</tr>";

			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '5'></td>";
			echo "<td width = 80%> 5. Вывести список водителей, у которых сегодня выходной </td>";
			echo "<input type=hidden name='zapros5'  value=' select SNAME, FNAME from driver_bus where ID_DRIVER not in (select ID_DRIVER from trip)'>";
			echo "</tr>";
			
			$result1=MYSQL_QUERY("select ID_TRIP,POINT_1,POINT_2 from route join trip on trip.ID_ROUTE = route.ID_ROUTE") or die ("Ошибка при выполнении запроса: ".mysql_error());
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '6'></td>";
			echo "<td width = 50% align = left> 6. Вывести фамилии пассажиров и количество забронированных мест, на рейс  ";
			echo "<select name = 'p6'>";
			 while($row1 = mysql_fetch_array($result1))
		     {
				 echo "<option value = ".$row1['ID_TRIP'].">".$row1['ID_TRIP']."   -  ".$row1['POINT_1']."  -  ".$row1['POINT_2']."</option>";
			 }			
			 echo "</select></pre></td>";
			 echo "<input type=hidden name='zapros6'  value='select SNAME_PAS,SEATS_NUMBER from e_ticket '>";
					echo "<input type=hidden name='par6'  value=' where ID_TRIP = '>";
					
			
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '7'></td>";
			echo "<td width = 50% align = left> 7. Вывести фамилии тех водителей, кому в этом году исполняется меньше  ";
			echo "<input type=text name='p7' size='1' value=''>  лет  </td>";
			echo "<input type=hidden name='zapros7'  value='select SNAME,FNAME,BDAY from driver_bus '>";
					echo "<input type=hidden name='par7'  value=' where (year(now())-year(BDAY))<'>";
			
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '8'></td>";
			echo "<td width = 80%> 8.Посчитать сколько мест забронировано на каждый рейс  </td>";
			echo "<input type=hidden name='zapros8'  value='select trip.ID_TRIP,POINT_1,POINT_2, sum(SEATS_NUMBER) from e_ticket join (trip join route on trip.ID_ROUTE= route.ID_ROUTE) on e_ticket.ID_TRIP = trip.ID_TRIP group by POINT_1,POINT_2,trip.ID_TRIP'>";
			echo "</tr>";
			
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '9'></td>";
			echo "<td width = 80%> 9. Посчитать количество автобусов каждой марки </td>";
			echo "<input type=hidden name='zapros9'  value='select MARKA, count(*) from driver_bus group by MARKA'>";
			echo "</tr>";			
				
			echo "<tr><td width =10% align = right><input type = radio name = 'rad' value = '10'></td>";
			echo "<td width = 50% align = left> 10. Найти все рейсы, которые затратят на маршрут больше  ";
			echo "<input type=time name='p10' size='1' value=''>  часов  </td>";
			echo "<input type=hidden name='zapros10'  value='SELECT POINT_1,POINT_2,DEPARTURE_TIME, ARRIVAL_TIME from route join trip on route.ID_ROUTE = trip.ID_ROUTE  '>";
              			echo "<input type=hidden name='par10'  value='where timediff(ARRIVAL_TIME, DEPARTURE_TIME)>'>";
			echo "</tr>";			
			
			echo "<tr></tr><tr></tr><tr><td colspan = '3' align = 'center'><input type = submit name = 'do' value = 'Выполнить'></td></tr>";
		
		echo "</table>";
	echo"</form>";



	MYSQL_CLOSE(); 
	function get_post($var)
	{
		return mysql_real_escape_string($_POST[$var]);
	}
?>
<a href='trip.php' target='_self'> Назад</a>