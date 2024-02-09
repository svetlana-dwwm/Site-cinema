<?php

try {
    $db = new PDO('mysql:host=' . $_ENV['DB_HOST'] .';dbname=' .$_ENV['DB_NAME'] . ';charset=UTF8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $db;
} catch (PDOException $e) {
    if ($_ENV['DEBUG']) {
        dump($e->getMessage());
    } else {
        echo 'Erreur';
        die;
    } 
}    
