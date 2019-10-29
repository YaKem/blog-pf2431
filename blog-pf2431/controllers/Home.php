<?php

    namespace Controllers;

    require_once('autoload.php');

    class Home extends Controller
    {
        /**
         * @var
         */
        protected $modelName = \Models\Home::class;

        /**
         * Afficher les Articles du plus récent au plus ancien
         */
        public function showHome()
        {
            $articles = $this->model->selectAll();
            //print_r($articles); die();

            $manager = new \Models\Article();
            $lastArticles = $manager->lastArticles();

            \Renderer::render('home', ['articles' => $articles, 'lastArticles' => $lastArticles]);
        }
    }