<?php

function showDetails () 
{
    global $db;

    $sql = "SELECT movies.*, GROUP_CONCAT(categories.name SEPARATOR '  ,  ') AS category_names
            FROM movies
            LEFT JOIN movies_categories ON movies.id = movies_categories.movie_id
            LEFT JOIN categories ON categories.id = movies_categories.category_id
            WHERE movies.slug = :slug
            GROUP BY movies.id";

    $query = $db->prepare($sql);
    $query->execute(['slug' => $_GET['slug']]);

    return $query->fetch();
}
