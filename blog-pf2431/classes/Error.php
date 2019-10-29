<?php

    class Error
    {
        public function setMessage(string $name, string $message)
        {
            $_SESSION[$name][] = $message;
        }
    }