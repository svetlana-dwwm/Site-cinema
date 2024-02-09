<?php

global $db;
global $router;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Delete associated records (foreign key restrictions) in movies_categories
    $sqlCategories = "DELETE FROM movies_categories WHERE movie_id = :id";
    $queryCategories = $db->prepare($sqlCategories);
    $queryCategories->bindParam(':id', $id);
    $queryCategories->execute();

    // Now delete the movie record in the 'movies' table
    $sql = "DELETE FROM movies WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();

    // Assuming $router->generate('listMovies') returns the correct URL
    $listMoviesURL = $router->generate('listMovies');
    header("Location: $listMoviesURL");
    exit; // Ensure that no further code is executed after the redirect
}

