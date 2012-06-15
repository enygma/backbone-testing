<?php

namespace Fw;

class Router
{
    private $_controller = 'index';
    private $_action     = 'index';
    private $_format     = 'html';

    public function handle()
    {
        // if it's for the favicon.ico, disregard
        if ($_SERVER['REQUEST_URI'] == '/favicon.ico') { return false; }

        // split off the query string if it's there
        $requestUri = str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);

        $params = array();
        if (!empty($_SERVER['QUERY_STRING'])) {
            $parts = explode('&',$_SERVER['QUERY_STRING']);
            foreach ($parts as $index => $value) {
                $p = explode('=',$value);

                $params[$p[0]] = $p[1];
            }
        }

        // get the request URL and break it up
        $uriParts = explode('/',
            substr($requestUri,1,strlen($requestUri))
        );
        if(!empty($uriParts[0])){
            $this->_controller = $uriParts[0];
            $this->_action     = $uriParts[1];
        }
        
        // see if we have an extension for the requested output
        if (strpos($this->_action,'.') !== false) {
            $this->_format = substr(
                $this->_action,
                strrpos($this->_action,'.')+1
            );
            $this->_action = str_replace('.'.$this->_format,'',$this->_action);
        }

        // now, load up our controller and make the object
        $controller = 'App\\Controller\\'.ucwords($this->_controller).'Controller';
        $c = new $controller();
        $c->setParams($params);
        
        $method = $this->_action.'Action';

        if (method_exists($c,$method)) {
            $c->$method();

            // render the view
            $v = new View(
                array(
                    'controller' => $this->_controller,
                    'action'     => $this->_action
                )
            );
            $v->setContent($c->getContent());
            $v->setFormat($this->_format);
            $v->render();

        } else {
            throw new \Exception('Method "'.$method.'" not found!');
        }
    }   
}

?>