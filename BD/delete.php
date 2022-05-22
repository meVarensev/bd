<?php
  require('connect_db.php');
  $sql = 'DELETE FROM book WHERE id = '.$_GET['id'];
  $query = $pdo->query($sql);

  header('Location: index.php');
?>