<?php

    class Http
    {
        /**
         * Redirige vers url
         * 
         * @param string $url
         * @return void
         */
        public static function redirect(string $url)
        {
            header("Location: $url");
            exit();
        }
    }