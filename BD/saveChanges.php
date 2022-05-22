<?php
  require('connect_db.php');

  $sql = 'UPDATE book SET title = "'.$_POST['book_title'].'",
                                           year = "'.$_POST['book_year'].'",
                                           category_id = '.$_POST['book_category'].', 
                                           description = "'.$_POST['book_description'].'" WHERE id = '.$_POST['book_id'];
  $query = $pdo->query($sql);

  $dquery = $pdo->query('DELETE FROM book_genre WHERE book_id = '.$_POST['book_id']);
  $genres = $_POST['book_genre'];
  
  if($genres){
  foreach ($genres as $genre) {
    $query = $pdo->query('INSERT INTO book_genre(book_id, genre_id) VALUES ('.$_POST['book_id'].', '.$genre.')');
  }}
  header('Location: index.php');
?>