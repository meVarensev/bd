<?
  $dblocation = "localhost";
  $dbname = "rgr";
  $dbuser = "root";
  $dbpasswd = "";
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$dbcnx) exit("<p>� ���������, �� �������� ������ MySQL</p>");
  if (!@mysql_select_db($dbname,$dbcnx)) 
exit("<p>� ���������, �� �������� ���� ������: ".mysql_error()."</p>");
?>