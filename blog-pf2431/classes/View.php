<?php

    class View
    {
        private $template;

        public function __construct($template = null)
        {
            $this->template = $template;
        }

        public function render($params = [])
        {
            extract($params);
            ob_start();
            include(VIEW."/$template.php");
            $contentPage = ob_get_clean();
            include_once(VIEW."/layout.php");
        }
    }