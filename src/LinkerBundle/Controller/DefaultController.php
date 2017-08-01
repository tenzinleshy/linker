<?php

namespace LinkerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LinkerBundle:Default:index.html.twig');
    }
}
