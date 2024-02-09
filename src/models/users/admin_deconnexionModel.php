<?php

unset($_SESSION['user']['id']);
alert('Vous êtes déconnecté.', 'success');
header('Location: ' . $router->generate('login'));
die;