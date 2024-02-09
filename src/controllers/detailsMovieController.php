<?php

$movie = showDetails ();

if (!empty($movie)) {
    $data['movie'] = $movie;
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    die('404 - Page Not Found');
}



/*if (!empty($category)) {
    $category['name'] = $category;
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    die('404 - Page Not Found');
}*/

