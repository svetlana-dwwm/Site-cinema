<?php

if (!empty($_GET['id']) && !empty(getAlreadyExistId()->id) && countUsers() > 1) {
        deleteUser();
        alert('Success', 'success');
    } else {
        alert('Impossible de supprimer', 'danger');
}
header('Location:' . $router->generate('users'));
die;

