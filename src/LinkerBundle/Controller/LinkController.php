<?php

namespace LinkerBundle\Controller;

use LinkerBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    {
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
        if ($form->isValid()) {
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

//    /**
//     * Displays a form to edit an existing post entity.
//     *
//     */
//    public function editAction(Request $request, Post $post)
//    {
//        $deleteForm = $this->createDeleteForm($post);
//        $editForm = $this->createForm('Leshy\BlogBundle\Form\PostType', $post);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
//        }
//
//        return $this->render('post/edit.html.twig', array(
//            'post' => $post,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Deletes a post entity.
//     *
//     */
//    public function deleteAction(Request $request, Post $post)
//    {
//        $form = $this->createDeleteForm($post);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($post);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('post_index');
//    }
//
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
