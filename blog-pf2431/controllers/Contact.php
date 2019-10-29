<?php

    namespace Controllers;

    require_once('autoload.php');

    class Contact extends Controller
    {
        protected $modelName = \Models\Contact::class;

        /**
         * Affiche le formulaire de contact
         */
        public function showForm()
        {
            $manager = new \Models\Article();
            $lastArticles = $manager->lastArticles();

            \Renderer::render('contact', ['lastArticles' => $lastArticles]);
        }

        /**
         * Ajoute un nouveau contact
         * @param array $params
         * @return avoid
         */
        public function addContact(array $params)
        {       
            extract($params);

            $_SESSION['values']['firstname'] = $values['firstname'];
            $_SESSION['values']['lastname'] = $values['lastname'];
            $_SESSION['values']['email'] = $values['email'];
            $_SESSION['values']['content'] = $values['content'];

            if(empty($values['firstname'])) {
                $_SESSION['errors'][] = "Vous n'avez pas saisi votre nom";
            };
            if(empty($values['lastname'])) {
                $_SESSION['errors'][] = "Vous n'avez pas saisi votre prénom";
            };
            if(empty($values['email']) || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors'][] = "Vous n'avez pas saisi votre email";
            };
            if(empty($values['content'])) {
                $_SESSION['errors'][] = "Vous n'avez pas saisi votre message";
            };
            if(!empty($_SESSION['errors'])) {
                $this->showForm();
                //exit();
            }

            $this->model->insert($values);

            \Http::redirect('index.php');
        }
    }