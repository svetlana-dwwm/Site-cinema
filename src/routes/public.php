<?php
$router->addMatchTypes(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*']);

// Movies
$router->map( 'GET|POST', '/', 'home', 'home');
$router->map( 'GET', '/recherche', 'search');
$router->map( 'GET', '/film/[slug:slug]', 'detailsMovie', 'details');

// Pages
$router->map( 'GET', '/politique-confidentialite', 'privacy');
$router->map( 'GET', '/mentions-legales', 'legalNotice');