<?php

function errorLogin () 
{
    $maxAttempts = 5;
    $banTime = 2 * 60 * 60; // 2 hours in seconds
    
    // Checking if the access is allowed
    if (isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts']++;
        
        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $_SESSION['ban_time'] = time();
            alert("L'entrée est temporairement interdite. Veuillez patienter " . $banTime . " secondes.");
            exit;
        }
    } else {
        $_SESSION['login_attempts'] = 1;
    }
}

function checkUserAccess ()
{
    global $db;
    $sql = 'SELECT id, pwd FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->execute(['email' => $_POST['email']]);

    $user = $query->fetch();

    if ($user && password_verify($_POST['pwd'], $user->pwd)) {
        unset($_SESSION['login_attempts']);
        return $user->id;
    } else {
        errorLogin();
    }
}


function saveLastLogin (string $userId)
{
    global $db;
    $sql = 'UPDATE users SET lastLogin = NOW() WHERE id = :id';
    $query = $db->prepare($sql);
    $query->execute(['id' => $userId]);

    return $query->rowCount();
}

