<?php
session_start();
ob_start();
            //require './core/ConfigController.php';
            require './vendor/autoload.php';
            $home = new Core\ConfigController();
            $home->loadPage();
        
   