<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>bookApp</title>
</head>

<body class="bg-dark"> 
  <header class="d-flex flex-column flex-md-row align-items-center justify-content-between p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <p class="h5 my-0 me-md-auto fw-normal">Все <?= $_POST['origin']=='native'?'Отечествынный':'Зарубежный'?> из фильма "<?=$_POST['book_title']?>" и другие фильмы, в которых они снимались</p>
    <a class="btn btn-outline-primary" href="queries.php">Назад</a>
  </header>
  <div class="container"> 

    <?php 
        require('connect_db.php');

        $sql = 'SELECT r.Sname, r.Fname, GROUP_CONCAT(b.title separator "<br>") AS books FROM
                (SELECT a.id AS id, a.Sname AS Sname, a.Fname AS Fname
                 FROM book_author ba
                 JOIN book b ON ba.book_id=b.id
                 JOIN author a ON ba.author_id=a.id
                 WHERE b.title LIKE "'.$_POST['book_title'].'" AND origin="'.$_POST['origin'].'") r
                 JOIN  book_author ba ON ba.author_id=r.id
                 JOIN book b ON b.id=ba.book_id
                 GROUP BY r.id
        ';
    ?>  


    <p class="text-center h5 text-light"><?=$sql?></p><br>

  <div class="d-flex flex-wrap">
    <?php
        $query = $pdo->query($sql);
        if (!$query->rowCount()) echo '<p class="h3">Set is empty</p>';
        while ($row = $query->fetch(PDO::FETCH_OBJ)): 
    ?>
        
    <div class="col-md-12">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0 text-primary"><?=$row->Sname.', '.$row->Fname?></h3>
      
                <p class="text-warning">Другие книги:</p>
                <p class="text-light"><?=$row->books?></p>
            </div>
            
        </div>
    </div>
    <?php endwhile?>
  </div>
  </div>



</body>
</html>