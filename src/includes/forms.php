<?php

/**Check if a field is empty
@param string $field
@param string $message
@return array
*/

function checkEmptyFields ($field, $message = 'Veuillez renseigner cette information.')
{
    $result    = ['class' => '', 'message' => ''];

    if (isset($_POST[$field]) && empty($_POST[$field])) {
        $result = [
            'class' => 'is-invalid',
            'message' => '<span class="invalid-feedback">' . $message . '</span>'
        ];
    } 

    return $result;
}

function getValue (string $field): string   // Добавим в input value (View)
{
    if (isset($_POST[$field])) {
        return $_POST[$field];
    }
    return '';
}