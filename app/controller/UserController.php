<?php

namespace App\Controller;

class UserController extends \Fw\Controller
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

    public function viewAction()
    {
        $this->content = null;
    }
}

?>