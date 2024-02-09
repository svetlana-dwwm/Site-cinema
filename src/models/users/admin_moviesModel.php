<?php


// Check if the email is already in the database*/
function checkAlreadyExistMovie(): mixed
{
    global $db;

    if (!isset($_POST['title'])) {
        return false; // or handle the absence of 'title' key in $_POST
    }

    $lowercaseTitle = strtolower($_POST['title']);
    $sql = 'SELECT title FROM movies WHERE LOWER(title) LIKE :title';
    $query = $db->prepare($sql);
    $query->bindParam(':title', $lowercaseTitle, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}


// Add a movie in the database
function addMovie(): bool
{
    $filename = uploadFile();
    $dateFromForm = !empty($_POST['date']) ? $_POST['date'] : null;

    global $db;
    $movie = [
        'title' => $_POST['title'],
        'slug' => renameFile($_POST['title']),
        'date' => $dateFromForm,
        'time' => $_POST['time'],
        'description' => $_POST['description'],
        'casting' => $_POST['casting'],
        'direction' => $_POST['direction'],
        'note' => floatval($_POST['note']),
        'poster' => $filename,
        'trailer' => $_POST['trailer']
    ];

    $selectedCategory = isset($_POST['category']) ? $_POST['category'] : null;

    try {
        $db->beginTransaction();

        // Insert into the movies table
        $sqlMovie = 'INSERT INTO movies (title, date, time, description, casting, direction, note, poster, slug) 
                     VALUES (:title, :date, :time, :description, :casting, :direction, :note, :poster, :slug)';
        $queryMovie = $db->prepare($sqlMovie);
        $queryMovie->execute([
            'title' => $movie['title'],
            'date' => $movie['date'],
            'time' => $movie['time'],
            'description' => $movie['description'],
            'casting' => $movie['casting'],
            'direction' => $movie['direction'],
            'note' => $movie['note'],
            'poster' => $movie['poster'],
            'slug' => $movie['slug']
        ]);

        // Get the last inserted movie ID
        $movieId = $db->lastInsertId();

        // Retrieve the category ID based on the selected category name
        $sqlCategory = 'SELECT id FROM categories WHERE name = :category';
        $queryCategory = $db->prepare($sqlCategory);
        $queryCategory->execute(['category' => $selectedCategory]);
        $categoryId = $queryCategory->fetchColumn();

        // Insert into the movies_categories table
        $sqlMoviesCategories = 'INSERT INTO movies_categories (movie_id, category_id) VALUES (:movieId, :categoryId)';
        $queryMoviesCategories = $db->prepare($sqlMoviesCategories);
        $queryMoviesCategories->execute([
            'movieId' => $movieId,
            'categoryId' => $categoryId
        ]);

        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        dump($e->getMessage());
        die;
    }

    return true;
}

 
function updateMovie ()
{
    if (empty($_POST['poster'])) {
        $filename = uploadFile(); // Call uploadFile to get the generated filename
    }
    $dateFromForm = !empty($_POST['date']) ? $_POST['date'] : null;
    global $db;
    $movie = [
        'id' => $_GET['id'],
        'title' => $_POST['title'],
        'date' => $dateFromForm,
       /* 'time' => $_POST['time'],*/
        'description' => $_POST['description'],
        'casting' => $_POST['casting'],
        'direction' => $_POST['direction'],
        'note' => floatval($_POST['note']),
        'poster' => $filename
    ];

    try {
        $sql = 'UPDATE movies 
                SET title = :title,
                    date = :date,
                   /* time = :time,*/
                    description = :description,
                    casting = :casting,
                    direction = :direction,
                    note = :note,
                    poster = :poster
                WHERE title = :title';
        $query = $db->prepare($sql);
        $query->execute(['title' => $movie['title'],
                        'date' => $movie['date'],
                        /*'time' => $movie['time'],*/
                        'description' => $movie['description'],
                        'casting' => $movie['casting'],
                        'direction' => $movie['direction'],
                        'note' => $movie['note'],
                        'poster' => $movie['poster']
       ]);
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }

    return true;
}

function updateUser (): void
{
    global $db;
    $data = [
        'id' => $_GET['id'],
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT)
    ];

    try {
        $sql = 'UPDATE users SET email = :email, pwd = :pwd, updated = NOW() WHERE id = :id';
        $query = $db->prepare($sql);
        $query->execute($data);
        alert('Un utilisateur a bien ete modifie.');
    } catch (PDOException $e) {
        // Всю эту часть можно засунуть в фукнцию, чтоб не повторяться
        if($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Erreur est survenue', 'danger');
        }
}}

function checkDateFormat($dateString, $format = 'Y-m-d'): bool
{
    /*if (!empty($dateString)) {*/
        $dateSortie = DateTime::createFromFormat($format, $dateString);
        return $dateSortie && $dateSortie->format($format) === $dateString;
}

function showCategories () 
{
    global $db;

    $sql = 'SELECT name FROM categories ORDER BY name DESC';
    $query = $db->prepare($sql);
    $query->execute();

    // Fetch all rows instead of just one
    return $query->fetchAll(PDO::FETCH_ASSOC);
}







 










/*function uploadImage ()
{
    global $db;

    if (empty($_FILES)) :
		return '';
	endif;

    $fileName = $_FILES["poster"]["name"];
    $tempName = $_FILES["poster"]["tmp_name"];
    $fileSize = $_FILES['poster']['size'];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));

    if(!in_array($imageExtension, $validImageExtension)) {
        alert('Invalid Image Extension');
    } else if ($fileSize > 2097152) {
        alert('Image size is too big');
    }
    else {
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;
        $folder = "./images/" . $newImageName;

        move_uploaded_file($tempName, $folder);
    
        $sql = "INSERT INTO upload (filename) VALUES ('$newImageName')";
        $query = $db->prepare($sql);
        $query->execute();
    }
}*/


