<?php

namespace Core;

abstract class Config
{
    protected function configAdm()
    {
        define('URL', 'http://localhost/celke/');
        define('URLADM', 'http://localhost/celke/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');
        define('EMAILADM', 'kevinalencar2019@gmail.com');
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'celke');
        define('PORT', '3308');
    } 
}