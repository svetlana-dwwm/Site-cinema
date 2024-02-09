<?php

     $errorMovie = [
        'title' => false,
        'date' => false
     ];
     
     if (!empty($_POST['title'])) {
         $dateFromForm = isset($_POST['date']) ? $_POST['date'] : null;
    
        if (!empty($_GET['id']) && (empty($dateFromForm) || checkDateFormat($dateFromForm))) {  
            updateMovie();
            alert('Un film a bien été modfié.', 'success');
         } else {
             $errorMovie['date'] = "Invalid date format. Please enter the date in the format YYYY-MM-DD.";
         }
     }