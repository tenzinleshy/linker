<?php

namespace LinkerBundle\Controller;

use LinkerBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Link controller.
 *
 */
class LinkController extends Controller
{
    /**
     * Lists all links entities.
     *
     */
    public function indexAction()
    {//die('ddd');
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('LinkerBundle:Link')->findAll();

        return $this->render('link/index.html.twig', array(
            'links' => $links,
        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction(Request $request)
    {
        $link = new Link();
        $link->setUsesCount(0);
        $link->setCreatedAt(new \DateTime(date("Y-m-d H:i:s")));

        $form = $this->createForm('LinkerBundle\Form\LinkType', $link);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirectToRoute('link_show', array('id' => $link->getId()));
        }

        return $this->render('link/new.html.twig', array(
            'link' => $link,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new link entity.
     *
     */
    public function newAPIAction(Request $request)
    {
        $link = new Link();
        $link->setUsesCount(0);
        $link->setCreatedAt(new \DateTime(date("Y-m-d H:i:s")));

        $form = $this->createForm('LinkerBundle\Form\LinkType', $link);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();
            $array = array( 'status' => 201, 'msg' => 'Link Created', 'short_link' => $link->getShortUrlId());
        }else{
            $errors = array();
            foreach ($form->getErrors() as $error) {
                $errors[$form->getName()][] = $error->getMessage();
            }
            // Fields
            foreach ($form as $child) {
                if (!$child->isValid()) {
                    foreach ($child->getErrors() as $error) {
                        $errors[$child->getName()][] = $error->getMessage();
                    }
                }
            }
            $array = array( 'status' => 400, 'errorMsg' => 'Bad Request', 'errorReport' => $errors); // data to return via JSON
        }
        $response = new JsonResponse();
        $response->setData($array);
        return $response;

    }

    /**
     * Finds and displays a post entity.
     *
     */
    public function showAction(Link $link)
    {
        $deleteForm = $this->createDeleteForm($link);

        return $this->render('link/show.html.twig', array(
            'link' => $link,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Link $link)
    {
        $form = $this->createDeleteForm($link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($link);
            $em->flush();
        }

        return $this->redirectToRoute('link_new');
    }


    /**
     * Creates a form to delete a link entity.
     *
     * @param Link $link The link entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Link $link)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('link_delete', array('id' => $link->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



}
