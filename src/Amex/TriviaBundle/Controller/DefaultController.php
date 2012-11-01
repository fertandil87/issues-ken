<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AmexTriviaBundle:Default:index.html.twig');
    }
    public function inicioAction()
    {
        return $this->render('AmexTriviaBundle:Default:inicio.html.twig');
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
