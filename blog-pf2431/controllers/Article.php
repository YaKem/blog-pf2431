<?php

    namespace Controllers;

    require_once('autoload.php');

    class Article extends Controller
    {
        protected $modelName = \Models\Article::class;

        /**
         * Affiche un article et les posts correspondants par ordre antéchronologique
         * 
         * @param array $params
         * @return avoid
         */
        public function showArticle(array $params)
        {           
            $article = $this->model->selectOne($params);

            extract($params);
            
            $manager = new \Models\Post();
            $posts = $manager->selectAllForArticle($id, "DESC");

            $lastArticles = $this->model->lastArticles();

            \Renderer::render('article', ['article' => $article, 'posts' => $posts, 'lastArticles' => $lastArticles]);
        }

        /**
         * Affiche le résultat de la recherche d'un mot et les 3 derniers articles publiés
         * 
         * @param array $params
         * @return avoid
         */
        public function search(array $params)
        {                
                $res = $this->model->searchInArticles($params);

                $lastArticles = $this->model->lastArticles();
                extract($res);
                \Renderer::render('search', ['results' => $results, 'keyword' => $keyword, 'lastArticles' => $lastArticles]);
        }

        /**
         * Affiche les catégories existantes dans la bdd et les 3 derniers articles
         * 
         * @param array $params
         * @return avoid
         */
        public function showCategory(array $params)
        {
            $results = $this->model->findCategory($params);

            $lastArticles = $this->model->lastArticles();

            \Renderer::render('category', ['results' => $results, 'lastArticles' => $lastArticles]);
        }
    }