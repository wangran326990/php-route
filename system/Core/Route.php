<?php
/**
 * Created by PhpStorm.
 * User: Ran
 * Date: 5/4/2016
 * Time: 11:34 AM
 */

namespace Project\system\Core;


class Route
{
    private $methods = array();
    private $pattern =null;
    private $callback = null;
    private $params = array();

    private $method = null;
    private $currentUri = null;

    public function __construct($method, $pattern, $callback){
        $this->methods = array_map('strtoupper',is_array($method)? $method : array($method));
        $this->pattern = ! empty($pattern)? $pattern :'/';
        $this->callback = $callback;
    }

    public function match($uri, $method){
        if(! in_array($method, $this->methods)){
            return false;
        }
        $this->method = $method;
        if($this->pattern === $uri){
            $this->currentUri = $uri;
            return true;
        }
    }
}