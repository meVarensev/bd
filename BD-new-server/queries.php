<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>bookApp</title>
</head>

<body class =" bg-dark ">

<header class="d-flex flex-column flex-md-row align-items-center justify-content-between p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <p class="h5 my-0 me-md-auto fw-normal">Queries</p>

  <a class="btn btn-outline-primary" href="index.php">Главная</a>
</header>
    <div class="container">
        <!-- форма 1-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query1.php">
          <div class="d-flex justify-content-between">
            <div>
              <span> 1) Книги, выпущенные </span>
              <select name="period" >
                <option value="<">до</option>
                <option value=">">после</option>
                <option value="=">в</option>
              </select>
              <input name="book_year" type="number" min="1950" max="2021" step="1" value="2000" class="mx-1" required/>
              <span>г.</span>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 2-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query2.php">
          <div class="d-flex justify-content-between">
            <div>
              <span> 2) Книги, в названии которых содержится</span>
              <input name="title_template" type="text" class="mx-1" required/>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 3-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query3.php">
          <div class="d-flex justify-content-between">
            <div>
              <span> 3) Книги, которые относятся к категории</span>
              <select name="book_category" class="mx-1">

                    <?php
                        require('connect_db.php');
                        //$pdo = new PDO("mysql:host=localhost;dbname=vitalaqw_book_db", "user1", "");
                        $query = $pdo->query('SELECT id, title FROM category');
                        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                            echo '<option value="'.$row->title.'">'.$row->title.'</option>';
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 4-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query4.php">
          <div class="d-flex justify-content-between">
            <div>
                <span> 4) Все жанры книг </span>
                <input name="book_title" type="text" class="mx-1" required/>
                <span>и их описание</span>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 5-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query5.php">
          <div class="d-flex justify-content-between">
            <div>
                <span> 5) Все </span>
                <select name="origin">
                    <option value="native">отечественные</option>
                    <option value="foreign">зарубежные</option>
                </select>
                <span> авторы, написавшие книгу </span>
                <input name="book_title" type="text" class="mx-1" required/>
                <span> и другие книги, которые они написали</span>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 6-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query6.php">
          <div class="d-flex justify-content-between">
            <div>
                <span> 6) Отзывы ко всем книгам за последние </span>
                <input name="interval" type="number" min="0" max="360" step="1" value="0" class="mx-1" required/>
                <span> дней</span>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

        <!-- форма 7-->
        <form class="border rounded overflow-hidden p-3 bg-dark text-light" method="POST" action="query7.php">
          <div class="d-flex justify-content-between">
            <div>
                <span> 7) Количество отзывов для каждой книги</span>
            </div>
            <button type="submit" class="btn btn-info">Выполнить</button>
          </div>
        </form>

    </div>
</body>

</html>



