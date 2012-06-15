<?php

namespace App\Controller;

class IndexController extends \Fw\Controller
{
    public function indexAction()
    {
        $this->content = array(
            array(
                'username'  => 'mytest',
                'location'  => 'Frisco, Tx',
                'name'      => 'Resa Cornutt',
                'id'        => 1
            )
        );
    }
}

?>