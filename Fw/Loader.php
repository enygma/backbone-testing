<?php

/**
 * PSR-0 compliant autoloader
 */
namespace Fw;

class Autoload
{
    public function __construct()
    {
        spl_autoload_register(array($this,'loader'));
    }
    public function loader($className)
    {
        $classFile = str_replace('\\','/',$className).'.php';
        
        if (is_file($classFile)) {
            include_once $classFile;
        } else {
            throw new \Exception('Class file '.$classFile.' not found!');
        }
    }
}

?>