<?php
/**
 * Coding is mostly based on Yii2 Framework
 */
namespace helpers\route;

use helpers\request\Request AS REQUEST_CLASS;

class Route{
    //TODO: pretty URL
    public $enablePrettyUrl = false;

    public $routeParam = 'r';

    public $isStrict = false;

    public function getRouteRequest()
    {
        $route = (new REQUEST_CLASS)->getRequest($this->routeParam);

        if (is_array($route)) {
            $route = '';
        }

        return (string) $route;
    }

    public function parseRoute()
    {
        $r = self::getRouteRequest();
        $route = explode('/',$r);

        if(!$this->isStrict){
            foreach($route as $key => $r){
                $route[$key] = ucfirst($r);
            }
        }
        return $route;
    }

}