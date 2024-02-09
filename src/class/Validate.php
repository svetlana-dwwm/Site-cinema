<?php

namespace App;

class Validate {

    /**
     * Check email format
     * @param string email
     * @return bool
     */
    public function email (string $email): bool
    {
       return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check password format
     * @param string password
     * @return bool
     */
    public function password (string $password): bool
    {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{10,}$/';
        return preg_match($regex, $password);
    }

    /**
     * Check 2 string match
     * @param string first
     * @param string second
     * @return bool
     */
    public function match (string $first, string $second): bool
    {
      return ($first === $second) ? true : false;
    }
}