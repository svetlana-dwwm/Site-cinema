<?php

// Showing list of movies
    global $db;
    $movies = [];
    $sql = 'SELECT * FROM movies';
    $query = $db->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll(PDO::FETCH_ASSOC);


