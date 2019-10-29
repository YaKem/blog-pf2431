<?php

    spl_autoload_register(function($class)
    {
        $class = str_replace("\\", "/", $class);

        //echo $class; die();

        if(file_exists("controllers/$class.php"))
        {
            require_once("controllers/$class.php");
        } else if(file_exists("models/$class.php"))
        {
            require_once("models/$class.php");
        } else if(file_exists("classes/$class.php"))
        {
            require_once("classes/$class.php");
        } else if(file_exists("$class.php"))
        {
            require_once("$class.php");
        }
    });