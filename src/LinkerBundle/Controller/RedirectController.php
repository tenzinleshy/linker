<?php

namespace LinkerBundle\Controller;

use LinkerBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RedirectController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $link = $em->getRepository('LinkerBundle:Link')->findOneBy(['shortUrlId'=>$id]);
        $usesCount = $link->getUsesCount();
        $link->setUsesCount(++$usesCount);
        $em->persist($link);
        $em->flush();

        return $this->redirect($link->getUrl());


    }
}
