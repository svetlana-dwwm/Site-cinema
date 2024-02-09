<?php

// Format de l'email

$errorMovie = [
    'title' => false,
    'date' => false
 ];
 
 if (!empty($_POST['title'])) {
     $dateFromForm = isset($_POST['date']) ? $_POST['date'] : null;

    if (!empty(checkAlreadyExistMovie())) {  
        $errorMovie['title'] = "Ce film existe déjà";
        updateMovie();
     } else if (empty($dateFromForm) || checkDateFormat($dateFromForm)) {
         addMovie();
         alert('Un film a bien été ajouté.', 'success');
     } else {
         $errorMovie['date'] = "Invalid date format. Please enter the date in the format YYYY-MM-DD.";
     }
 }

// Uploading image
 if (isset($_FILES['poster'])) {
    uploadFile();
}
    
$categories = showCategories();












/*$dateFromForm = $_POST['date'];  // Make sure to sanitize user input
if (checkDateFormat($dateFromForm)) {
    return true;
    echo 'Added';
} else {
    $errorMovie['date'] = "Invalid date format. Please enter the date in the format DD-MM-YYYY.";
}

// Save user in database
   /* if(!empty($_POST['title'])) {  // Checking if the fields are not empty
            if(!$errorsMessage['email'] && !$errorsMessage['pwd'] && !$errorsMessage['pwdConfirm']) { // Just $errorMessage?
                if(!empty($_GET['id'])) {
                    updateUser();
                } else {
                    addUser(); 
                }

                alert('Un utilisateur a bien ete ajoute.', 'success');
            } else {
                alert('Erreur');
            }
    } else {
        alert('Merci de remplir tous les champs obligatoires.');
    }*/
?>


    