<?php

// Check if the email is already in the database
function checkAlreadyExistEmail (): mixed
{
    global $db;

    if(!empty($_GET['id'])) {
        $email = getUser()->email;

        if ($email === $_POST['email']) {
            return false;
        }
    }

    $sql = 'SELECT email FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

 
// Add a user in the database
function addUser (string $message)
{
    global $db;
    $data = [
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'role_id' => 1
    ];

    try {
        $sql = 'INSERT INTO users (id, email, pwd, role_id) VALUES (UUID(), :email, :pwd, :role_id)';
        $query = $db->prepare($sql);
        $query->execute($data);
        alert($message, 'success');
    } catch (PDOException $e) {
        if($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Erreur est survenue', 'danger');
        }
}}

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

/**
 * Get current user
 */
function getUser ()
{
    global $db;

    try {
        $sql = 'SELECT email FROM users WHERE id = :id';
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

}}


$errorsMessage = [
    'email' => false,
    'pwd' => false,
    'pwdConfirm' => false
];

if (!empty($_POST)) {
    if (!empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errorsMessage['email'] = "L'email n'est pas valide";
        } else if (!empty(checkAlreadyExistEmail())) {
            $errorsMessage['email'] = "L'adresse email existe déjà";
        }
    }

    if (!empty($_POST['pwd'])) {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{10,}$/';
        if (!preg_match($regex, $_POST['pwd'])) {
            $errorsMessage['pwd'] = "Merci de respecter le format indiqué";
        } else if ($_POST['pwd'] !== $_POST['pwdConfirm']) {
            $errorsMessage['pwdConfirm'] = "N'est pas identique";
        }
    }

    if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['pwdConfirm'])) {
        if (!$errorsMessage['email'] && !$errorsMessage['pwd'] && !$errorsMessage['pwdConfirm']) {
            if (!empty($_GET['id'])) {
                updateUser();
                alert('Un utilisateur a bien été modifié.', 'success');
            } else {
                addUser('Un utilisateur a bien été ajouté.');
                // header('Location: ');
                // die;
            }
        } else {
            alert('Erreur lors de l\'ajout de l\'utilisateur.');
        }
    } else {
        alert('Merci de remplir tous les champs obligatoires.');
    }
} else if (!empty($_GET['id'])) {
    // Read user data and save to $_POST
    $_POST = (array) getUser();
}


/*namespace App;

class User extends Database {
    
    public function add ()
    {
        $sql = 'INSERT INTO users (id, email, pwd, role_id) VALUES (UUID(), :email, :pwd, :role_id)';
        $data = [
            'email' => $_POST['email'],
            'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
            'role_id' => 1
        ];
        $this->executeRequest($sql, $data);
        $query = $db->prepare($sql);
        $query->execute($data);
        alert($message, 'success');
    } catch (PDOException $e) {
        if($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Erreur est survenue', 'danger');
        }
}}
    }

    public function update ()
    {
        
    }

    public function getOne ()
    {
        
    }

    public function checkAlreadyExistEmail ()
    {
        
    }
}*/