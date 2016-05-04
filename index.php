<?php
/**
 * Created by PhpStorm.
 * User: Ran
 * Date: 5/4/2016
 * Time: 10:17 AM
 */

require_once "./autoloader.php";
use Project\system\Core\Router;
//get Router instance;
 Router::getInstance();
 Router::any('helloWorld','App\Controllers\Index@helloWorld');

