<?php

namespace Fw;

class View
{
    private $_content = null;
    private $_format  = null;

    private $_config  = array();

    public function __construct($config=null)
    {
        if ($config !== null) {
            $this->_config = $config;
        }
    }

    private function _getConfig($name)
    {
        return (isset($this->_config[$name])) ? $this->_config[$name] : null;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }
    public function setFormat($format)
    {
        $this->_format = $format;
    }
    public function render()
    {
        $viewPath        = realpath(__DIR__.'/../app/view');
        $defaultViewFile = $viewPath.'/'.$this->_format.'.php';

        // check to see if the action view file exists
        $actionViewFile = $viewPath.'/'.$this->_getConfig('controller').'/'.$this->_getConfig('action').'.'.$this->_format.'.php';

        if (is_file($actionViewFile)) {
            $viewFile = $actionViewFile;
        }

        if (is_file($viewFile)) {
            $this->content = $this->_content;
            include_once $viewFile;
        } else {
            throw new \Exception('View file "'.$this->_format.'" not found!');
        }

        //$viewFile = 
    }
}

?>