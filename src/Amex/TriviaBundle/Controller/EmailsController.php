<?php

namespace Amex\TriviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmailsController extends Controller
{
    public function indexAction($country)
    {
        $request   = $this->getRequest();
        $countries = array('arg' => 1, 'mex' => 2);

        if ($request->isMethod('POST')) {
            $emailTitle = 'Amex :: The Global Experience';
            $emailFrom  = 'example@mail.com';

            $idUser = $request->request->get('to');
            
            if ($request->request->get('type') == 'welcome') {
                if ($idUser == 'all') {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->findBy(array(
                        'role'    => 'ROLE_USER',
                        'country' => $countries[$country],
                    ));
                    foreach ($user as $item) {
                        $this->sendWelcomeEmail($emailTitle, $emailFrom, $item->getEmail(), $item->getName());
                    }
                } else {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($idUser);
                    $this->sendWelcomeEmail($emailTitle, $emailFrom, $user->getEmail(), $user->getName());
                }

            } elseif ($request->request->get('type') == 'dailywin') {
                $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($idUser);
                $this->sendWinnerEmail($emailTitle, $emailFrom, $user->getEmail(), $user->getName(), $request->request->get('reward'));

            } elseif ($request->request->get('type') == 'finalwin') {
                $user1 = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($request->request->get('user1'));
                $user2 = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($request->request->get('user2'));
                $user3 = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($request->request->get('user3'));
                if ($idUser == 'all') {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->findBy(array(
                        'role'    => 'ROLE_USER',
                        'country' => $countries[$country],
                    ));
                    foreach ($user as $item) {
                        $this->sendFinalWinnerEmail($emailTitle, $emailFrom, $item->getEmail(), $user1->getName(), $user2->getName(), $user3->getName());
                    }
                } else {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($idUser);
                    $this->sendFinalWinnerEmail($emailTitle, $emailFrom, $user->getEmail(), $user1->getName(), $user2->getName(), $user3->getName());
                }

            } elseif ($request->request->get('type') == 'instructions') {
                if ($idUser == 'all') {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->findBy(array(
                        'role'    => 'ROLE_USER',
                        'country' => $countries[$country],
                    ));
                    foreach ($user as $item) {
                        $this->sendInstEmail($emailTitle, $emailFrom, $item->getEmail());
                    }
                } else {
                    $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->find($idUser);
                    $this->sendInstEmail($emailTitle, $emailFrom, $user->getEmail());
                }

            } elseif ($request->request->get('type') == 'motivation') {
                $user = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->findBy(array(
                    'role'    => 'ROLE_USER',
                    'country' => $countries[$country],
                ));
                foreach ($user as $item) {
                    if ($item->getId() != $idUser) {
                        $this->sendMotivEmail($emailTitle, $emailFrom, $item->getEmail(), $item->getName());
                    }
                }
            }
        } 

        $users = $this->getDoctrine()->getRepository('AmexTriviaBundle:User')->findBy(array(
            'role'    => 'ROLE_USER',
            'country' => $countries[$country],
        ));

        return $this->render('AmexTriviaBundle:Admin:emails.html.twig', array(
            'users' => $users,
        ));
    }


    public function sendWelcomeEmail($emailTitle, $emailFrom, $emailTo, $userName)
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/';

        $message = \Swift_Message::newInstance()
            ->setSubject($emailTitle)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('AmexTriviaBundle:Email:bienvenida.html.twig', array(
                'baseUrl'  => $baseurl,
                'userName' => $userName,
            )), 'text/html');
        $this->get('mailer')->send($message);
    }


    public function sendWinnerEmail($emailTitle, $emailFrom, $emailTo, $userName, $reward)
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/';

        $message = \Swift_Message::newInstance()
            ->setSubject($emailTitle)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('AmexTriviaBundle:Email:ganadorDelDia.html.twig', array(
                'baseUrl'  => $baseurl,
                'userName' => $userName,
                'reward'   => $reward,
            )), 'text/html');
        $this->get('mailer')->send($message);
    }


    public function sendFinalWinnerEmail($emailTitle, $emailFrom, $emailTo, $userName1, $userName2, $userName3)
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/';

        $message = \Swift_Message::newInstance()
            ->setSubject($emailTitle)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('AmexTriviaBundle:Email:ganadorFinal.html.twig', array(
                'baseUrl'   => $baseurl,
                'userName1' => $userName1,
                'userName2' => $userName2,
                'userName3' => $userName3,
            )), 'text/html');
        $this->get('mailer')->send($message);
    }


    public function sendInstEmail($emailTitle, $emailFrom, $emailTo)
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/';

        $message = \Swift_Message::newInstance()
            ->setSubject($emailTitle)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('AmexTriviaBundle:Email:mecanica.html.twig', array(
                'baseUrl' => $baseurl,
            )), 'text/html');
        $this->get('mailer')->send($message);
    }


    public function sendMotivEmail($emailTitle, $emailFrom, $emailTo, $userName)
    {
        $request = $this->getRequest();
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . '/';

        $message = \Swift_Message::newInstance()
            ->setSubject($emailTitle)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('AmexTriviaBundle:Email:motivador.html.twig', array(
                'baseUrl'  => $baseurl,
                'userName' => $userName,
            )), 'text/html');
        $this->get('mailer')->send($message);
    }
}
