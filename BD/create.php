<?php
  require('connect_db.php');

  $sql = 'INSERT INTO book(title, year, category_id, description) VALUES 
  ("'.$_POST['book_title'].'", "'.$_POST['book_year'].'", '.$_POST['book_category'].', "'.$_POST['book_description'].'")';

  $query = $pdo->query($sql);


  $temp_id = $pdo->query('SELECT id FROM book ORDER BY id DESC LIMIT 1');
  $temp_id = $temp_id->fetch();
  $temp_id = $temp_id[0];


  $genres = $_POST['book_genre'];
  if($genres){
    foreach ($genres as $genre) {
      $sql_ = 'INSERT book_genre(book_id, genre_id) VALUES ('.$temp_id.', '.$genre.')';
      $query_ = $pdo->query($sql_);
  }}
  header('Location: index.php');

?>