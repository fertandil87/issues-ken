<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    private function verifySession($userId){
        $session = $this->getRequest()->getSession();
        $desafioDate = $session->get('desafio_'.$userId.'_date');
        if(date('Y-m-d') == $desafioDate){
            return $this->redirect($this->generateUrl('amex_trivia_trivia'));
        }
    }
    public function indexAction()
    {
        return $this->render('AmexTriviaBundle:Default:index.html.twig');
    }
    public function inicioAction()
    {
        $logout = $this->get('router')->generate('logout');
        $msg = '';
        $usr= $this->get('security.context')->getToken()->getUser();
        $id = $usr->getId();
        $this->verifySession($id);
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT c FROM AmexTriviaBundle:Challenge c WHERE c.date LIKE '".date('Y-m-d')."%' "
        )->setMaxResults(1);
        $challenge = current($query->getResult());
        if (!$challenge){
            $msg = "<h2 class='mensajeInicio'>No hay trivias o desafios para hoy.</h2>
                <a href='".$logout."'>Logout</a>";
        }else{
            $query = $em->createQuery(
                "SELECT ua FROM AmexTriviaBundle:UserAnswer ua WHERE ua.user = :id AND ua.challenge = :challenge"
            )->setParameter('id',$id)->setParameter('challenge',$challenge->getId())->setMaxResults(1);
            $userPlayed = current($query->getResult());
            if(!$userPlayed){
                switch ($challenge->getType()->getId()){
                    case 1:
                            $url = $this->get('router')->generate('amex_trivia_trivia');
                            break;
                    case 2: 
                            $url = $this->get('router')->generate('amex_trivia_desafio');
                            break;
                    case 3: 
                            $url = $this->get('router')->generate('amex_trivia_verdadero_falso');
                            break;
                }
                $msg = '<a class="botonDesafio" href="'.$url.'"> Comenzar </a> ';
            }else{
                $msg = "<h2 class='mensajeInicio'>Ya has jugado la trivia de hoy.<h2>
                    <a href='".$logout."'>Logout</a>";
            }
        }
       

        return $this->render('AmexTriviaBundle:Default:inicio.html.twig',array('msg' => $msg));
    }
    
    public function registroAction()
    {
        return $this->render('AmexTriviaBundle:Default:registro.html.twig');
    }
    public function recuperarClaveAction()
    {
        return $this->render('AmexTriviaBundle:Default:recuperarClave.html.twig');
    }
}
