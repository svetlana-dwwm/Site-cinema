<?php


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

    

/*use App\Validate;

if (!empty($_POST)) {
    $errors = ['email' => false, 'pwd' => false, 'pwdConfirm' => false];


    $validate = new Validate;
    $validate->email($_POST['email']);
    $errors['email'] = (!$validate->email($_POST['email']) ? 'Email non valide.' : '');
    $errors['pwd'] = (!$validate->password($_POST['pwd']) ? 'MDP non valide.' : '');
    $errors['pwdConfirm'] = (!$validate->match($_POST['pwd'], $_POST['pwdConfirm']) ? 'Les mots de passe ne .' : '');

    if (count(array_filter($errors)) === 0) {
        $user = new User;
        (!empty($_GET['id'])) ? update() : add();
        header('Location: ' . $router->generate('users'));
        die;
    } else {
        alert('Merci de remplir tous les champs obligatoires.');
    }
} else if (!empty($_GET['id'])) {
    $_POST = (array) getUser();
}*/