<?php

    class Router
    {
        private static $path = 'home';
        private static $paths = [
            'home'             => ['controller' => 'Home',    'method' => 'showHome'    ],
            'article'          => ['controller' => 'Article', 'method' => 'showArticle' ],
            'article-category' => ['controller' => 'Article', 'method' => 'showCategory'],
            'article-search'   => ['controller' => 'Article', 'method' => 'search'      ],
            'contact'          => ['controller' => 'Contact', 'method' => 'showForm'    ],
            'create-contact'   => ['controller' => 'Contact', 'method' => 'addContact'  ],
            'post'             => ['controller' => 'Post',    'method' => 'showPost'    ],
            'create-post'      => ['controller' => 'Post',    'method' => 'addPost'     ],
            'about'            => ['controller' => 'About',   'method' => 'showAbout'   ],
            'error404'         => ['controller' => 'Error',   'method' => 'showError'   ]
        ];

        public static function renderController()
        {
            if(!empty($_GET['r'])) {
                self::$path = $_GET['r'];
                self::$path = strtolower(self::$path);
                $elements = explode("/", self::$path);
                self::$path = $elements[0];
            }

            if(isset($elements[1])) {
                $params = [$elements[1] => $elements[2]];
            } else {
                $params = [];
            }

            if(!empty($_POST)) {
                foreach($_POST as $k => $v) {
                    $params[$k] = $v;
                }
            }     

            if(array_key_exists(self::$path, self::$paths)) {
                $controller = self::$paths[self::$path]['controller'];
                $method = self::$paths[self::$path]['method'];

                $controllerName = "\Controllers\\".$controller;
                
                $controller = new $controllerName();
                $controller->$method($params);
            } else {
                \Renderer::render('404');
            }
        }
    }