<?php

    namespace Models;

    require_once('autoload.php');

    class Contact extends Model
    {
        protected $table = 'contacts';

        /**
         * Insert item
         * @param array $params
         * @return void
         */
        public function insert($params)
        {
            extract($params);

            $query = "INSERT INTO {$this->table} (firstName, lastName, email, content, createdAt) VALUES (?, ?, ?, ?, NOW())";
            $req = $this->pdo->prepare($query);
            $req->execute([$firstname, $lastname, $email, $content]);
        }
    }    