<?php

    namespace Models;

    abstract class Model
    {
        protected $pdo;
        protected $table;

        /**
         * Au moment de l'instanciation des class filles, connection à la bdd
         */
        public function __construct()
        {
            $this->pdo = \Database::getPdo();
        }

        /**
         * Retourne tous les items dans l'ordre $order s'il existe
         * @param array
         * @return array
         */
        public function selectAll(array $order = [])
        {
            $sql = "SELECT * FROM {$this->table}";

            if($order) {
                $sql .= " ORDER BY ".$order;
            }
                    
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $results = $query->fetchAll();
            return $results;
        }

        /**
         * Retourne l'item de paramètre id
         * @param array
         * @return array
         */
        public function selectOne(array $params)
        {
            if(is_array($params)) {
                extract($params);
            } else {
                $id = $params;
            }
                       
            $query = "SELECT * FROM {$this->table} WHERE id = ?";
            $req = $this->pdo->prepare($query);
            $req->execute([$id]);
            $result = $req->fetch();
            return $result;
        }        
        
        /**
         * Insère un item
         * @param array $params
         * @return void
         */
        public function insert(array $params)
        {
            extract($params);

            $query = "INSERT INTO {$this->table} (title, content, image, author, createdAt) VALUES (?, ?, ?, ?, NOW())";
            $req = $this->pdo->prepare($query);
            $req->execute([$title, $content, $image, $author]);
        }
    
        /**
         * Met à jour un item
         * @param array $params
         * @return void
         */
        public function update(array $params)
        {
            extract($params);

            $query = "UPDATE {$this->table} SET title = ?, content = ?, image = ?, author = ? WHERE id = ?";
            $req = $this->pdo->prepare($query);
            $req->execute([$title, $content, $image, $author, $id]);
        }
    
        /**
         * Supprime un item d'identifiant id
         * @param array $params
         * @return void
         */
        public function delete(array $params)
        {
            extract($params);

            $query = "DELETE FROM {$this->table} WHERE id = ?";
            $req = $this->pdo->prepare($query);
            $req->execute([$id]);
        }
    }