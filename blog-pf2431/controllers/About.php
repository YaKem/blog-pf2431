<?php

    namespace Controllers;

    require_once('autoload.php');

    class About
    {
        public function showAbout()
        {
            $manager = new \Models\Article();
            $lastArticles = $manager->lastArticles();

            \Renderer::render('about', ['lastArticles' => $lastArticles]);
        }
    }