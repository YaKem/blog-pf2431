<?php

    namespace Models;

    require('autoload.php');

    class Post extends Model
    {
        protected $table = 'posts';

        /**
         * Insère un post
         * @param array $params
         * @return void
         */
        public function insert(array $params)
        {

            extract($params);

            $query = "INSERT INTO {$this->table} (name, email, content, article_id, createdAt) VALUES (?, ?, ?, ?, NOW())";
            $req = $this->pdo->prepare($query);
            $req->execute([$name, $email, $content, $article_id]);
        }

        /**
         * Retourne tous les posts d'un article donné par ordre antéchronologique
         * @param int $id
         * @param string $order
         * @return array
         */
        public function selectAllForArticle(int $id, string $order)
        {
            $sql = "SELECT * FROM {$this->table} WHERE article_id = ?";

            if($order) {
                $sql .= " ORDER BY createdAt ".$order;
            }

            $query = $this->pdo->prepare($sql);
            $query->execute([$id]);
            $results = $query->fetchAll();
            return $results;
        }
    }