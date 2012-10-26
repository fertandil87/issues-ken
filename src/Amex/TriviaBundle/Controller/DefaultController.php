<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AmexTriviaBundle:Default:index.html.twig', array('name' => $name));
    }
}
