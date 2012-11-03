<?php

namespace Amex\TriviaBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TriviaController extends Controller {

    private function getChallenge() {
        $usr = $this->get('security.context')->getToken()->getUser();
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
        return null;
    }
    private function verifySession($userId){
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->get('desafio_'.$userId.'_inicio');
        $desafioDate = $session->get('desafio_'.$userId.'_date');
        if(date('Y-m-d') != $desafioDate){
            $this->setSession($userId);
        }
    }
    private function setSession($userId){
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->set('desafio_'.$userId.'_inicio',time());
        $desafioDate = $session->get('desafio_'.$userId.'_date',date('Y-m-d'));
    }
    private function deleteSession($userId){
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->remove('desafio_'.$userId.'_inicio');
        $desafioDate = $session->remove('desafio_'.$userId.'_date');
    }
    private function getTotalTimeFromSession($userId){
        $session = $this->getRequest()->getSession();
        $desafioInicio = $session->get('desafio_'.$userId.'_inicio');
        return (time()-$desafioInicio);
    }

    public function verdaderoFalsoAction() {
        $challenge = $this->getChallenge();
        if (empty($challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        $answer = $challenge->getAnswer();
        return $this->render('AmexTriviaBundle:Trivias:verdadoFalso.html.twig');
    }

    public function triviaAction() {
        $usr= $this->get('security.context')->getToken()->getUser();
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
        $challenge = $this->getChallenge();
        if (empty($challenge))
            return $this->redirect($this->generateUrl('amex_trivia_inicio'));
        return $this->render('AmexTriviaBundle:Trivias:desafio.html.twig');
    }

}
