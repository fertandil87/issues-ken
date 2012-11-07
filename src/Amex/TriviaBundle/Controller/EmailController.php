<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;

class EmailController extends Controller
{
    public function bienvenidaAction()
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
        return $this->render('AmexTriviaBundle:Email:bienvenida.html.twig',array('baseUrl'=>$baseurl));
    }
    public function mecanicaAction()
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
        return $this->render('AmexTriviaBundle:Email:mecanica.html.twig',array('baseUrl'=>$baseurl));
    }
    public function motivadorAction()
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
        return $this->render('AmexTriviaBundle:Email:motivador.html.twig',array('baseUrl'=>$baseurl));
    }
    public function ganadorDiaAction()
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
        return $this->render('AmexTriviaBundle:Email:ganadorDelDia.html.twig',array('baseUrl'=>$baseurl));
    }
    public function ganadorFinalAction()
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
        return $this->render('AmexTriviaBundle:Email:ganadorFinal.html.twig',array('baseUrl'=>$baseurl));
    }
    
}
