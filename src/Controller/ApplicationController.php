<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    /**
     * @Route("/application", name="application")
     */
    public function index(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'ApplicationController',
        ]);
    }
    /**
     * @Route("/locale/{locale}", name="change_locale")
     */
    public function changeLocale(Request $request, string $locale,SessionInterface $session)
    {
        $session->set('_locale', $locale);
        return $this->redirect($request->headers->get('referer') );
    }
}
