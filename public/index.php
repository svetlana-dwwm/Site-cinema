<?php

use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
require '../vendor/autoload.php';

// Constants
define('SRC', '../src/');

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(SRC . 'config');
$dotenv->load();

session_start(); // We declare this to use $_SESSION for saving inserted data 

require SRC . 'config/database.php';
require SRC . 'includes/forms.php';
require SRC . 'class/Validate.php';
require SRC . 'class/Database.php';

$router = new AltoRouter();
//$router->setBasePath('/movies');

require SRC . 'routes/public.php';
require SRC . 'routes/admin.php';

$match = $router->match();
require SRC . 'includes/functions.php';
logoutTimer();

// Twig
$loader = new FilesystemLoader(SRC . 'views');
$twig = new Environment($loader, ['cache' => false, 'debug' => true]);
$twig->addExtension(new DebugExtension());
require_once SRC . 'includes/twig.php';

if (!empty($match['target'])) {
	checkAdmin($match, $router);
	
	$_GET = array_merge($_GET, $match['params']);
	$data = []; // Data to be sent to the view
	require SRC . 'models/' . $match['target'] . 'Model.php';
	require SRC . 'controllers/' . $match['target'] . 'Controller.php';

	// Load twig template or classic view
    if (file_exists(SRC . 'views/' . $match['target'] . '.twig')) {
        echo $twig->render($match['target'] . '.twig', $data);
    } else {
        require SRC . 'views/' . $match['target'] . 'View.php';
	}
} else {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	die('404');
}
