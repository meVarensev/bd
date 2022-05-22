<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>bookApp</title>
</head>

<body class="bg-dark"> 
  <header class="d-flex flex-column flex-md-row align-items-center justify-content-between p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">

    <p class="h5 my-0 me-md-auto fw-normal">Фильмы, которые относятся к категории "<?= $_POST['book_category']?>"</p>
    <a class="btn btn-outline-primary" href="queries.php">Назад</a>
  </header>
  <div class="container"> 

    <?php 
        require('connect_db.php');
        //$sql = 'SELECT * FROM book WHERE category_id = '.$_POST['book_category'].' ORDER BY id DESC';
        $sql = "SELECT *, b.title AS b_title, c.title AS c_title  FROM book b JOIN category c ON b.category_id = c.id WHERE c.title LIKE '".$_POST['book_category']."' ORDER BY b.id DESC";
    ?>  

    <p class="text-center h5 text-light"><?=$sql?></p>


  <div class="d-flex flex-wrap">
    <?php
        $query = $pdo->query($sql);
        if (!$query->rowCount()) echo '<p class="h3">Set is empty</p>';
        while ($row = $query->fetch(PDO::FETCH_OBJ)): 
    ?>
        
    <div class="col-md-12">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">
                    <?=$row->c_title;?>
                </strong>
                <h3 class="mb-0 text-light"><?=$row->m_title?></h3>
                <div class="mt-1 text-warning"><?=$row->year?>г.</div>
                <div class="mb-1 text-info">

                <?php
                    $sql1 = 'SELECT genre_id FROM book_genre WHERE book_id = '.$row->id;
                    $query1 = $pdo->query($sql1);
                    while ($row1 = $query1->fetch()) {
                        $sql2 = 'SELECT title FROM genre WHERE id = '.$row1[0];
                        $query2 = $pdo->query($sql2);
                        $query2 = $query2->fetch();
                        echo $query2[0].' ';
                    }
                ?>
                </div>
                <p class="card-text mb-auto text-light"><?=$row->description?></p>
            </div>
            
        </div>
    </div>
    <?php endwhile?>
  </div>
  </div>



</body>
</html>