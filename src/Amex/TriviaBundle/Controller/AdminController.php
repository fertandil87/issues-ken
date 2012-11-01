<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('AmexTriviaBundle:Admin:index.html.twig');
    }
    public function loginAction()
    {
        return $this->render('AmexTriviaBundle:Admin:inicio.html.twig');
    }
   
}
