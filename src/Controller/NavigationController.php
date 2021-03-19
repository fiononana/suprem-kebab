<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class NavigationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Session $session)
    {
        $return = [];

        if($session->has('message'))
        {
            $message = $session->get('message');
            $session->remove('message'); //on vide la variable message dans la session
            $return['message'] = $message; //on ajoute à l'array de paramètres notre message
        }
        return $this->render('/home.html.twig', $return);
    }

    /**
     * @Route("/membre", name="membre")
     */
    public function membre(Session $session)
    {
        $return = [];

        if($session->has('message'))
        {
            $message = $session->get('message');
            $session->remove('message'); //on vide la variable message dans la session
            $return['message'] = $message; //on ajoute à l'array de paramètres notre message
        }
        return $this->render('/membre.html.twig', $return);
    }

    /**
     * @Route("/administration", name="admin")
     */
    public function admin(Session $session)
    {
        $user = $this->getUser();
        if(!$user)
        {
            $session->set("message", "Merci de vous connecter");
            return $this->redirectToRoute('app_login');
        }

        else if(in_array('ROLE_ADMIN', $user->getRoles())){
            return $this->render('/admin.html.twig');
        }
        $session->set("message", "Vous n'avez pas le droit d'acceder à la page admin vous avez été redirigé sur cette page");
        if($session->has('message'))
        {
            $message = $session->get('message');
            $session->remove('message'); //on vide la variable message dans la session
            $return['message'] = $message; //on ajoute à l'array de paramètres notre message
        }
        return $this->redirectToRoute('home', $return);

    }
}
