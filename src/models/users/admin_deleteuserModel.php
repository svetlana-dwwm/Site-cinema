<?php

/**
 * Delete a user from the database
 */
function deleteUser () 
{
    try {
        global $db;
        $sql = "DELETE FROM users WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute(['id' => $_GET['id']]);

        alert('L\'utilisateur a bien ete supprime', 'success');
    } catch (PDOException $e) {
        if($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Erreur est survenue', 'danger');
        }
    }
}

function getAlreadyExistId () 
{
    try {
        global $db;
        $sql = "SELECT id FROM users WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute(['id' => $_GET['id']]);

        return $query->fetch();
    } catch (PDOException $e) {
        if($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Erreur est survenue', 'danger');
        }
    }
}

function countUsers () 
{
    global $db;
    $sql = 'SELECT COUNT(*) FROM users';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchColumn();
}