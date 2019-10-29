<?php

    namespace Controllers;

    require('autoload.php');

    class Post extends Controller
    {
        protected $modelName = \Models\Post::class;

        /**
         * Affiche tous les commentaires par order antéchronologique
         * @param avoid
         * @return array $posts
         */
        public function showPost()
        {
            $posts = $this->model->findAll();

            return $posts;
        }

        /**
         * Ajout d'un nouveau commentaire
         * @param array $params
         * @return avoid
         */
        public function addPost(array $params)
        {
            extract($params);

            $this->model->insert($values);

            extract($values);

            $id = $values['article_id'];

            $manager = new \Models\Article();
            $article = $manager->selectOne($id);

            $posts = $this->model->selectAllForArticle($id, "DESC");

            \Renderer::render('article', ['article' => $article, 'posts' => $posts]);
        }
    }