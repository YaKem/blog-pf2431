<?php

    class Renderer
    {
        /**
         * Retourne la vue du chemin
         * 
         * @param string $path
         * @param array $params || void
         * @return void
         */
        public static function render(string $path, array $params = [])
        {
            extract($params);
            
            ob_start();
            require("views/$path.phtml");
            $contentPage = ob_get_clean();
            require_once("views/layout.phtml");
        }
    }