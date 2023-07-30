<?php
	$db=mysql_connect("localhost","root","");
	mysql_select_db("musicstore",$db);
	
	mysql_query("SET character_set_client = 'cp1251'");
	mysql_query("SET character_set_connection = 'cp1251'");
	mysql_query("SET character_set_results = 'cp1251'");
	mysql_query("SET NAMES 'cp1251'");
?>