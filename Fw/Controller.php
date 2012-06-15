<?php

namespace Fw;

class Controller
{
    public $content = null;
    private $_params = array();

    public function getContent()
    {
        return $this->content;
    }
    public function setParams($params)
    {
        $this->_params = $params;
    }
    public function getParam($name)
    {
        return (isset($this->_params[$name])) ? $this->_params[$name] : null;
    }
}

?>