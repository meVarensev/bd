<!DOCTYPE html>
<html lang="ru">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>bookApp</title>
</head>

<body class="bg-dark">
    <header class="d-flex flex-column flex-md-row align-items-center justify-content-between p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">book App</p>

        <a class="btn btn-outline-primary" href="queries.php">Запросы</a>
    </header>
    <div class="container">
        <!-- форма -->
        <form class="border rounded overflow-hidden p-3 bg-secondary text-light" method="POST" action="create.php">
            <h3>Добавить новую книгу</h3>
            <div>
                <label>Название</label>
                <input name="book_title" placeholder="название книги" maxlength="50" size="70" required /><br />
            </div>
            <div>
                <label>Год</label>
                <input name="book_year" type="number" min="1950" max="2021" step="1" value="2000" class="mr-5" required />
                <label>Категория</label>
                <!-- список всех категорий -->
                <select name="book_category">
                    <?php

                    require('connect_db.php');
                    $query = $pdo->query('SELECT id, title FROM category');
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        echo '<option value="' . $row->id . '">' . $row->title . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="align-top">Жанр</label>
                <!-- список всех жанров -->
                <select name="book_genre[]" multiple="multiple" size="3" class="form-select">
                    <?php
                    $query = $pdo->query('SELECT id, title FROM genre');
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        echo '<option value="' . $row->id . '">' . $row->title . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Описание</label><br />
                <textarea name="book_description" class="form-control"></textarea>
            </div>
            <div class="mt-2 text-right">
                <button type="submit" class="btn btn-info">Создать</button>
                <button type="reset" class="btn btn-dark">Очистить</button>
            </div>
        </form>
        <hr />

        <!-- список -->
        <div class="d-flex flex-wrap">
            <?php
            $query = $pdo->query('SELECT * FROM book ORDER BY id DESC');
            while ($row = $query->fetch(PDO::FETCH_OBJ)) :
            ?>
                <div class="col-md-12">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">
                                <?php
                                $sql1 = 'SELECT title FROM category WHERE id = ' . $row->category_id;
                                $query1 = $pdo->query($sql1);
                                $query1 = $query1->fetch();
                                echo $query1[0];
                                ?>
                            </strong>
                            <h3 class="text-light mb-0"><?= $row->title ?></h3>
                            <div class="mt-1 text-warning "><?= $row->year ?>г.</div>
                            <div class="mb-1 text-info">
                                <?php
                                $sql2 = 'SELECT genre_id FROM book_genre WHERE book_id = ' . $row->id;
                                $query2 = $pdo->query($sql2);
                                while ($row1 = $query2->fetch()) {
                                    $sql3 = 'SELECT title FROM genre WHERE id = ' . $row1[0];
                                    $query3 = $pdo->query($sql3);
                                    $query3 = $query3->fetch();
                                    echo $query3[0] . ' ';
                                }
                                ?>
                            </div>
                            <p class="text-light card-text mb-auto"><?= $row->description ?></p>
                        </div>


                        <!-- кнопки  -->
                        <div class="m-2">
                            <!-- изменение  -->
                            <form action="change.php" method="POST">
                                <input type="hidden" name="book_id" value="<?= $row->id ?>" />
                                <input type="hidden" name="book_title" value="<?= $row->title ?>" />
                                <input type="hidden" name="book_year" value="<?= $row->year ?>" />
                                <input type="hidden" name="book_category" value="<?= $row->category_id ?>" />
                                <input type="hidden" name="book_description" value="<?= $row->description ?>" />
                                <button class="btn btn-outline-primary">Изменить</button>
                            </form>
                            <!-- удаление -->
                            <a href="delete.php?id=<?= $row->id ?>"><button class="btn btn-outline-danger mt-1">Удалить</button></a>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
</body>

</html>