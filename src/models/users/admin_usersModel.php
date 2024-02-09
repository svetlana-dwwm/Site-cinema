<?php

function getUsers () {
    global $db;
    
    $sql = 'SELECT * FROM users';
    $query = $db->prepare($sql);
    $query->execute();
    
    return $query->fetchAll(); 
}

