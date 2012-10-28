<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TriviaController extends Controller
{
    public function verdaderoFalsoAction()
    {
        return $this->render('AmexTriviaBundle:Trivias:verdadoFalso.html.twig');
    }
    public function triviaAction()
    {
        return $this->render('AmexTriviaBundle:Trivias:trivia.html.twig');
    }
    public function desafioAction()
    {
        return $this->render('AmexTriviaBundle:Trivias:desafio.html.twig');
    }
}
