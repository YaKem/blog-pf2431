<?php

    namespace Models;

    require_once('autoload.php');

    class Article extends Model
    {
        protected $table = 'articles';

        /**
         * Recherche dans les articles (titre + contenu) le mot $keyword
         * @param array $params
         * @return array
         */
        public function searchInArticles(array $params)
        {
            extract($params);

            $sql = "SELECT * FROM articles WHERE CONCAT(title, ' ', content) LIKE '% $keyword %'";
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(\PDO::FETCH_ASSOC);

            $params = compact('results', 'keyword');

            return $params;
        }

        /**
         * Retourne la liste des commentaires d'un article $id du plus récent au plus ancien
         * @param array $params
         * @return array
         */
        public function findCategory(array $params)
        {
            extract($params);

            $sql = "SELECT title, content, author, categories.categoryName AS category, createdAt FROM articles INNER JOIN categories ON articles.category = categories.id WHERE category = ? ORDER BY createdAt DESC";
            $query = $this->pdo->prepare($sql);
            $query->execute([$id]);
            $results = $query->fetchAll(\PDO::FETCH_ASSOC);

            return $results;
        }

        /**
         * Retourne les 3 derniers articles
         * @return array
         */
        public function lastArticles()
        {
            $sql = "SELECT * FROM articles ORDER BY createdAt DESC LIMIT 3";

            $query = $this->pdo->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(\PDO::FETCH_ASSOC);

            return $results;
        }
    }