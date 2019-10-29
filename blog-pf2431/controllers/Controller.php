<?php

    namespace Controllers;

    abstract class Controller
    {
        protected $model;

        /**
         * au moment de l'instanciation des class filles, le modèle correspondant est instancié
         */
        public function __construct()
        {
            $this->model = new $this->modelName();
        }
    }