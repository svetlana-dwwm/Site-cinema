<?php

namespace App;

use PDO;
use PDOException;

class Database {

    private $db;

    public function __construct() {

        try {
            $this->db = new PDO('mysql:host=' . $_ENV['DB_HOST'] .';dbname=' .$_ENV['DB_NAME'] . ';charset=UTF8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->error($e);
        }
    }

    public function error (PDOException $e) {
        if ($_ENV['DEBUG']) {
            dump($e->getMessage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de reessayer plus tard.');
        }
    }

    protected function executeRequest (string $sql, array $data = []) {   // Устанавливаем данные пустой таблицей, чтобы использовать в любых запросах, в том числе, если $data пустая
        try {
            $query = $this->db->prepare($sql);
            return $query->execute($data);
        } catch (PDOException $e) {
            $this->error($e);
        }
    }
}

