<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute('moveout_new');

    }

    /**
     * @Route("/disconnect", name="disconnect")
     */
    public function disconnectAction(Request $request, SessionInterface $session)
    {
        $session->remove('moveOut');
        return $this->redirectToRoute('moveout_new');

    }
}
