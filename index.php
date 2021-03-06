<?php

/**
 * A simple PHP MVC skeleton
 * Jest to szkielet wzorca MVC do treningu. Staram się napisać w tym modelu 
 * aplikację pozwalającą na komunikacjępoprzez Z API STEAM w celu uzyskania 
 * infomracji o grach i użytkownikach.
 * szkielet MVC oraz metoda trimująca adres url zostala zaimplemementowana z 
 * poniższego przykładu 
 * dodawanie do develpmentu
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load application config (error reporting etc.)
require 'application/config/config.php';
require 'application/libs/classLoader.class.php';

//loader to load all .class.php files from dir application/models
classLoader::loadClass("application/models/");

// load application class
require 'application/libs/application.php';
require 'application/libs/controller.php';
require 'application/libs/model.php';

// start the application
$app = new Application();
