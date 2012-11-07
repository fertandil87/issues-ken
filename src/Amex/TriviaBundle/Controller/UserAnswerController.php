<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Amex\TriviaBundle\Entity\UserAnswer;
use Amex\TriviaBundle\Form\UserAnswerType;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * UserAnswer controller.
 *
 */
class UserAnswerController extends Controller
{
    /**
     * Lists all UserAnswer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('AmexTriviaBundle:UserAnswer')->findAll();
        $query = $em->createQuery(
                "SELECT ua FROM AmexTriviaBundle:UserAnswer ua ORDER BY ua.responseTime ASC"
            );
            $entities = $query->getResult();

        return $this->render('AmexTriviaBundle:UserAnswer:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a UserAnswer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAnswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AmexTriviaBundle:UserAnswer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new UserAnswer entity.
     *
     */
    public function newAction()
    {
        $entity = new UserAnswer();
        $form   = $this->createForm(new UserAnswerType(), $entity);

        return $this->render('AmexTriviaBundle:UserAnswer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new UserAnswer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new UserAnswer();
        $form = $this->createForm(new UserAnswerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('administrator_show', array('id' => $entity->getId())));
        }

        return $this->render('AmexTriviaBundle:UserAnswer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserAnswer entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAnswer entity.');
        }

        $editForm = $this->createForm(new UserAnswerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AmexTriviaBundle:UserAnswer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing UserAnswer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAnswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserAnswerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('administrator_edit', array('id' => $id)));
        }

        return $this->render('AmexTriviaBundle:UserAnswer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a UserAnswer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserAnswer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('administrator'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    public function galeriaAction($json)
    {
        $imagenes = json_decode($json,true);
       return $this->render('AmexTriviaBundle:UserAnswer:galeria.html.twig', array(
            'imagenes'      => $imagenes
        ));
    }
    
    public function correctoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAnswer entity.');
        }
        $entity->setRightAnswer(true);
        $em->persist($entity);
        $em->flush();
        $request = $this->getRequest();
        $referer = $request->headers->get('referer');       

        return new RedirectResponse($referer);
    }
    public function incorrectoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmexTriviaBundle:UserAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAnswer entity.');
        }
        $entity->setRightAnswer(false);
        $em->persist($entity);
        $em->flush();
        $request = $this->getRequest();
        $referer = $request->headers->get('referer');       

        return new RedirectResponse($referer);
    }
}
