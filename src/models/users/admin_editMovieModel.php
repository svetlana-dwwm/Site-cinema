<?php


function checkDateFormat($dateString, $format = 'Y-m-d'): bool
{
    /*if (!empty($dateString)) {*/
        $dateSortie = DateTime::createFromFormat($format, $dateString);
        return $dateSortie && $dateSortie->format($format) === $dateString;
}


function updateMovie(): void
{
    $filename = uploadFile();
    $dateFromForm = !empty($_POST['date']) ? $_POST['date'] : null;
    global $db;
    $movie = [
        'id' => $_GET['id'],
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

    try {
        $sql = 'UPDATE movies SET ';
        $params = [];

        foreach ($movie as $key => $value) {
            if ($value !== null && $value !== '' && $key !== 'id') {
                $sql .= "$key = :$key, ";
                $params[":$key"] = $value;  // Use the correct placeholder
            }
        }

        // Remove the trailing comma and space from the SET clause
        $sql = rtrim($sql, ', ');

        $sql .= ' WHERE id = :id';

        $query = $db->prepare($sql);
        $query->execute(array_merge($params, [':id' => $movie['id']]));
        alert('Un film a bien été modifié.');
    } catch (PDOException $e) {
        if ($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Une erreur est survenue', 'danger');
        }
    }
}

















