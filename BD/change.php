<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>bookApp</title>
</head>

<body class="bg-dark">
    <div class="container">
        <?php require('connect_db.php'); ?>
        <form class="border rounded overflow-hidden p-3 bg-secondary text-light" method="POST" action="saveChanges.php">
            <h3>Изменить книгу "<?= $_POST['book_title'] ?>"</h3>
            <input type="hidden" name="book_id" value="<?= $_POST['book_id'] ?>" />
            <div>
                <label>Название</label>
                <input name="book_title" placeholder="название книги" maxlength="50" size="70" required value="<?= $_POST['book_title'] ?>" /><br />
            </div>
            <div>
                <label>Год</label>
                <input name="book_year" type="number" min="1950" max="2021" step="1" value="<?= $_POST['book_year'] ?>" class="mr-5" required />
                <label>Категория</label>
                <select name="book_category">
                    <?php
                    $query = $pdo->query('SELECT * FROM category');
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        echo '<option value="' . $row->id . '"';
                        if ($row->id == $_POST['book_category']) echo ' selected';
                        echo '>' . $row->title . '</option>';
                    } ?>
                </select>
            </div>
            <div>
                <label class="align-top">Жанр</label>
                <?php

                $sql = 'SELECT genre_id FROM book_genre WHERE book_id = ' . $_POST["book_id"];
                $query1 = $pdo->query($sql);
                $ngenres = array();
                while ($genre = $query1->fetch()) {
                    array_push($ngenres, $genre[0]);
                }

                ?>
                <!-- список всех жанров -->
                <select name="book_genre[]" multiple="multiple" size="3" class="form-select">
                    <?php

                    $query = $pdo->query('SELECT id, title FROM genre');
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        $genre = $row->id;
                        echo '<option value="' . $genre . '"';
                        if (in_array($genre, $ngenres)) echo 'selected';
                        echo '>' . $row->title . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Описание</label><br />
                <textarea name="book_description" class="form-control"><?= $_POST['book_description'] ?></textarea>
            </div>
            <div class="mt-2 text-right">
                <button type="submit" class="btn btn-info">Изменить</button>
            </div>
        </form>
    </div>
</body>

</html>