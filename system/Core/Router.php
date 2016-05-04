<?php
/**
 * Created by PhpStorm.
 * User: Ran
 * Date: 5/4/2016
 * Time: 9:16 AM
 */

namespace Project\system\Core;


class Router
{
    private static $instance;
    private  $routes = array();
    private static $defaultRoute=null;
    protected $matchedRoute = "error";
    private $errorCallback = '\App\Controllers\Error@index';
    public static $methods = array('GET','POST');

    private function __construct(){
        //echo "in construct";

    }

    public function getInstance(){
        if(self::$instance==null){
            self::$instance = new Router();
            //$router = self::$instance;
        }
        $router = self::$instance;
        return $router;
    }

    public static function __callStatic($method, $arguments)
    {
        // TODO: Implement __callStatic() method.
        $method = strtoupper($method);
        if($method=='ANY' || in_array($method,self::$methods)) {
            $pattern = array_shift($arguments);
            $callback = array_shift($arguments);
            self::register($method, $pattern, $callback);

        }

    }

    public static function register($method, $route, $callback){
        $router = self::getInstance();

        if(is_string($method) && (strtoupper($method)=='ANY')){
            $methods = self::$methods;

        }else{
            $methods =array_map("strtoupper", is_array($method)? $method : array($method));
            $methods = array_intersect($methods, self::$methods);
        }

        if(empty($methods)){
            $methods = self::$methods;
        }

        $pattern = ltrim($route,'/');
        var_dump($pattern);
        $route = new Router($methods, $pattern, $callback);
        array_push($router->routes, $route);
    }
}