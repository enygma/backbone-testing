<?php

namespace App\Controller;

class TestController extends \Fw\Controller
{
    public function indexAction()
    {
        $this->content = array(
            'test'
        );
    }
}

?>