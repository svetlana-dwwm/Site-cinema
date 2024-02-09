<?php
/**
 * Get all movies order by added date
 */

// Get all movies
function getMovies()
{
    global $db;
    $sql = "SELECT * FROM movies ORDER BY created DESC";
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}