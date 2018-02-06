<?php

/**
 * Configuration
 */

/*Configuration for steam API.
Defined STEAM_API_KEY for connect with steam. Key is in seperate file in "higher" folder, not includet in repoaitory for security reasons. Normaly key would be here in config file.
*/
require '../cred/steamkey.php';
/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://localhost/MVC/SteamMVC/main/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'php-mvc');
define('DB_USER', 'root');
define('DB_PASS', '');
