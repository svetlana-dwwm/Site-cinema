<?php
/**
 * Get the header
 * @param  string $title  The title of the page
 * @param  string $layout The layout to use
 * @return void
 */
function get_header(string $title, string $layout ='public'): void
{
	global $router;
	require_once '../src/views/layouts/' . $layout . '/header.php';
}

/**
 * Get the footer
 * @param  string $layout The layout to use
 * @return void
 */
function get_footer (string $layout ='public'): void
{
	global $router;
	require_once '../src/views/layouts/' . $layout . '/footer.php';
}

/**
 * Get the alert
 * @param string $message The message to save in alert
 * @param string $type The type of alert
 * @return void
 */
function alert(string $message, string $type = 'danger') : void
{
	$_SESSION['alert'] = [    // First should be initialised in index.php (session_start())
		'message' => $message,   // Error message
		'type' => $type      // To add class for alert div
	];
}

/**
 * Display alert session
 * @return void
 */
function displayAlert () : void
{
	if (!empty($_SESSION['alert'])){    // Checking if the session exists
		echo '<div class="alert alert-' . $_SESSION['alert']['type'] . '" role="alert">' . $_SESSION['alert']['message'] . '</div>'; // Showing error message
		unset($_SESSION['alert']);    // Destroying the session
	}
}


/**
 * Check if user is logged in 
 * @param array $match The match param from Altorouter
 * @param AltoRouter $router The router
 */
function checkAdmin (array $match, AltoRouter $router) 
{
	//dump($_SESSION);
	//die;
	$existAdmin = strpos($match['target'], 'admin_');   // To block access to the admin part
	if ($existAdmin !== false && empty($_SESSION['user']['id'])) {
		header('Location: ' . $router->generate('login'));
		die;
	}
}

function logoutTimer ()
{
	global $router;

	if (!empty($_SESSION['user']['lastLogin'])) {
		$expireHour = 1;
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Europe/Paris'));

		$lastLogin = new DateTime($_SESSION['user']['lastLogin']);

		if ($now->diff($lastLogin)->h >= $expireHour) {
			unset($_SESSION['user']);
			alert('Vous etes deconnecte pour inactivite.', 'danger');
			header('Location: ' . $router->generate('login'));
			die;
		}
	}
}

// Uploading image

// Conversion to an understandable format
function formatBytes($size, $precision = 2) {
	$base = log($size, 1024);
	$suffixes = ['', 'Ko', 'Mo', 'Go', 'To'];

	return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

// Renaming the file, getting rid of useless symbols
function renameFile(string $name) {
	$name = trim($name);
	$name = strip_tags($name);
	$name = removeAccent($name);
    $name = preg_replace('/[\s-]+/', ' ', $name);  // Clean up multiple dashes and whitespaces
	$name = preg_replace('/[\s_]/', '-', $name); // Convert whitespaces and underscore to dash
	$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
	$name = strtolower($name);
	$name = trim($name, '-');

	return $name;
}

// Replacing letter accents
function removeAccent($string) {
	$string = str_replace(
		['à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'], 
		['a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'], 
		$string
	);
	return $string;
}

// Declaring classes we are going to use in the function
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/**	
 * Upload file
 * 
 * @param string $path to save file
 * @param string $field name of input type file
 */
function uploadFile(): string
{

    $path = 'images';
    $exts = ['jpg', 'png', 'jpeg'];
    $maxSize = 2097152;
    $field = 'poster';

	// Check submit form with post method
	if (empty($_FILES)) :
		return '';
	endif;
	
	// Check exit directory if not create
	if (!is_dir($path) && !mkdir($path, 0755)) :
		return 'Impossible d\'importer votre fichier.';
	endif;

	// Check not empty input file
	/*if (empty($_FILES[$field]['name'])) :
		return 'Merci d\'uploader un fichier';
	endif;*/
	
	// Check exts
	$currentExt = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
	$currentExt = strtolower($currentExt);
	if (!in_array($currentExt, $exts)) :
		$exts = implode(', ', $exts);
		return 'Merci de charger un fichier avec l\'une de ces extensions : ' . $exts . '.';
	endif;

	// Check no error into current file
	if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) :
		return 'Merci de sélectionner un autre fichier.';
	endif;

	// Check max size current file
	if ($_FILES[$field]['size'] > $maxSize) :
		return 'Merci de charger un fichier ne dépassant pas cette taille : ' . formatBytes($maxSize);
	endif;

	$filename = pathinfo($_FILES[$field]['name'], PATHINFO_FILENAME);
	$filename = renameFile($filename);
	$targetToSave = $path . '/' . $filename . '.' . $currentExt;

	if(move_uploaded_file($_FILES[$field]['tmp_name'], $targetToSave)) :
        $manager = new ImageManager(new Driver());
        $image = $manager->read($targetToSave);
        $image->scale(width: 350);
        $image->save($targetToSave);
		alert('Super !', 'success');
        return $targetToSave;
	endif;

	return '';
}

function searchByTitle ($name, $search) {                            // We're looking for the movie         
	$pos = strpos(strtolower($name), strtolower($search));
	if ($pos === false) {
		return false;
	} else {
		return true;
	}
}










/*function showMovie($movies) {
    $searchQuery = $_POST['search'];

    // Check if the search field is empty
    if (empty($searchQuery)) {
        return false;  // Return false to display all movies when search is empty
    }

    foreach ($movies as $movie) {
        if (searchByTitle($movie['title'], $searchQuery)) {
            return $movie;  // Return the movie if it matches the search criteria
        }
    }

    return false;  // Return false if no movie matches the search criteria
}*/

/*function showMovie($movies) {
    if (!empty($_POST['search'])) {
        foreach ($movies as $movie) {
            if (searchByTitle($movie['title'], $_POST['search'])) {
                return true;
            }
       }
    }

   return false;
}*/