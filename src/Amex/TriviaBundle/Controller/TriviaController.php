<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TriviaController extends Controller {

    private function getChallenge() {
        /* $usr = $this->get('security.context')->getToken()->getUser();
          $id = $usr->getId();
          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
          "SELECT c FROM AmexTriviaBundle:Challenge c WHERE c.date LIKE '" . date('Y-m-d') . "%' "
          )->setMaxResults(1);
          $challenge = current($query->getResult());
          if ($challenge) {

          $query = $em->createQuery(
          "SELECT ua FROM AmexTriviaBundle:UserAnswer ua WHERE ua.user = :id AND ua.challenge = :challenge"
          )->setParameter('id', $id)->setParameter('challenge', $challenge->getId())->setMaxResults(1);
          $userPlayed = current($query->getResult());
          if (!$userPlayed) {
          return $challenge;
          }
          }
          return null; */
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        "SELECT c FROM AmexTriviaBundle:Challenge c WHERE c.date LIKE '2012-11-14%' "
                )->setMaxResults(1);
        return current($query->getResult());
    }

    private function verifySession($userId) {
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->get('desafio_' . $userId . '_inicio');
        $desafioDate = $session->get('desafio_' . $userId . '_date');
        if (date('Y-m-d') != $desafioDate) {
            $this->setSession($userId);
        }
    }

    private function setSession($userId) {
        $session = $this->getRequest()->getSession();
        $session->set('desafio_' . $userId . '_inicio', time());
        $session->get('desafio_' . $userId . '_date', date('Y-m-d'));
    }

    private function deleteSession($userId) {
        $session = $this->getRequest()->getSession();
        $session->remove('desafio_' . $userId . '_inicio');
        $session->remove('desafio_' . $userId . '_date');
    }

    private function getTotalTimeFromSession($userId) {
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->get('desafio_' . $userId . '_inicio');
        return (time() - $desafioInicio);
    }

    public function verdaderoFalsoAction() {
        $usr = $this->get('security.context')->getToken()->getUser();
        $id = $usr->getId();
        $this->verifySession($id);
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        $consigna = empty($answer['consigna']) ? '' : $answer['consigna'];
        return $this->render('AmexTriviaBundle:Trivias:verdaderoFalso.html.twig', array(
                    'respuesta' => $answer['respuesta'],
                    'consigna' => $consigna,
                    'ayuda' => $ayuda,
                    'question' => $question
                ));
    }

    public function verdaderoFalsoCheckAction($respuesta) {
        $usr = $this->get('security.context')->getToken()->getUser();
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        $consigna = empty($answer['consigna']) ? '' : $answer['consigna'];
        $result = new \Amex\TriviaBundle\Entity\UserAnswer();
        $result->setAnswer($respuesta);
        $result->setChallenge($challenge);
        $result->setResponseTime($this->getTotalTimeFromSession($usr->getId()));
        $result->setDate(new \DateTime());
        $result->setUser($usr);
        if ($respuesta == $answer['respuesta']) {
            $result->setRightAnswer(true);
        } else {
            $result->setRightAnswer(false);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($result);
        $em->flush();
        $this->deleteSession($usr->getId());
        return $this->render('AmexTriviaBundle:Trivias:verdaderoFalso_respuesta.html.twig', array(
                    'respuesta' => $answer['respuesta'],
                    'consigna' => $consigna,
                    'ayuda' => $ayuda,
                    'question' => $question,
                    'respuesta_user' => $respuesta
                ));
    }

    public function triviaAction() {
        $usr = $this->get('security.context')->getToken()->getUser();
        $id = $usr->getId();
        $this->verifySession($id);
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        return $this->render('AmexTriviaBundle:Trivias:trivia.html.twig', array(
                    'answer' => $answer['opciones'],
                    'respuesta' => $answer['respuesta'],
                    'ayuda' => $ayuda,
                    'question' => $question
                ));
    }

    public function triviaCheckAction($respuesta) {
        $usr = $this->get('security.context')->getToken()->getUser();
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        $result = new \Amex\TriviaBundle\Entity\UserAnswer();
        $result->setAnswer($respuesta);
        $result->setChallenge($challenge);
        $result->setResponseTime($this->getTotalTimeFromSession($usr->getId()));
        $result->setDate(new \DateTime());
        $result->setUser($usr);
        if ($respuesta == $answer['respuesta']) {
            $result->setRightAnswer(true);
        } else {
            $result->setRightAnswer(false);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($result);
        $em->flush();
        $this->deleteSession($usr->getId());
        return $this->render('AmexTriviaBundle:Trivias:trivia_respuesta.html.twig', array(
                    'answer' => $answer['opciones'],
                    'respuesta' => $answer['respuesta'],
                    'respuesta_user' => $respuesta,
                    'ayuda' => $ayuda,
                    'question' => $question
                ));
    }

    public function desafioAction() {
        $usr = $this->get('security.context')->getToken()->getUser();
        $id = $usr->getId();
        $this->verifySession($id);
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        $consigna = empty($answer['consigna']) ? '' : $answer['consigna'];


        //create a simple form with one filed called "dataFile" of type "file"
        $form = $this->get('form.factory')
                ->createBuilder('form');
        for ($i = 1; $i <= $answer['opciones']; $i++) {
            $form = $form->add("dataFile" . $i, "file", array("required" => true, 'label' => ' '));
        }
        $form = $form->getForm();

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            //bind the request, (note the enctype in the template)
            $form->bindRequest($request);

            if ($form->isValid()) {
                //if the form is valid, try to get the uploaded file object
                //Symfony\Component\HttpFoundation\File\UploadedFile
                $files = $request->files->get($form->getName());
                //print_r($files);exit;
                $i = 0;
                $urls = array();
                foreach ($files as $file) {
                    $i++;
                    $uploadedFile = $file; //"dataFile" is the name on the field
                    //once you have the uploadedFile object there is some sweet functions you can run
                    $uploadedFile->getPath(); //returns current (temporary) path
                    $uploadedFile->getClientOriginalName();
                    $uploadedFile->getMimeType();

                    //and most important is move(), 
                    $url = "/uploads/user" . $id . "/challenge" . $challenge->getId() . '/imagen' . $i;
                    $urls[] = $url .'/'. $uploadedFile->getClientOriginalName();
                    $uploadedFile->move($_SERVER['DOCUMENT_ROOT'] .$this->get('request')->getBasePath() .$url, $uploadedFile->getClientOriginalName());
                }

                $result = new \Amex\TriviaBundle\Entity\UserAnswer();
                $result->setAnswer(json_encode($urls));
                $result->setChallenge($challenge);
                $result->setResponseTime($this->getTotalTimeFromSession($usr->getId()));
                $result->setDate(new \DateTime());
                $result->setUser($usr);
                if ($answer['opciones'] == count($urls)) {
                    $result->setRightAnswer(true);
                } else {
                    $result->setRightAnswer(false);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($result);
                $em->flush();
                $this->deleteSession($usr->getId());
                return $this->redirect($this->generateUrl('amex_trivia_desafio_resultado',array('uaId'=>$result->getId())));
            } else {
                //form is not valid
            }
        }
        return $this->render('AmexTriviaBundle:Trivias:desafio.html.twig', array(
                    'opciones' => 1,
                    'ayuda' => $ayuda,
                    'consigna' => $consigna,
                    'question' => $question,
                    'form' => $form->createView()
                ));
    }

    public function desafioCheckAction($uaId) {
        $usr = $this->get('security.context')->getToken()->getUser();
        $id = $usr->getId();
        $challenge = $this->getChallenge();
        if ((!$challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        
        $userAnswer = $this->getDoctrine()
        ->getRepository('AmexTriviaBundle:UserAnswer')
        ->find($uaId);
         if ((!$userAnswer))
             return $this->redirect($this->generateUrl('amex_trivia_inicio'));
         
        $answer = json_decode($challenge->getAnswer(), true);
        $question = $challenge->getQuestion();
        $ayuda = empty($answer['ayuda']) ? '' : $answer['ayuda'];
        $consigna = empty($answer['consigna']) ? '' : $answer['consigna'];
        return $this->render('AmexTriviaBundle:Trivias:desafio_respuesta.html.twig', array(
                    'opciones' => 1,
                    'ayuda' => $ayuda,
                    'question' => $question,
                    'consigna' => $consigna,
                    'respuesta' => json_decode($userAnswer->getAnswer(),true)
                ));
    }

}
