<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/consommateur/content", name="default_conso")
     */
    public function consommateurProfil(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CONSOMMATEUR', null, 'User tried to access a page without having ROLE_CONSOMMATEUR');

        return $this->render('default/conso.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    /**
     * @Route("/producteur/content", name="default_prod")
     */
    public function producteurProfil(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PRODUCTEUR', null, 'User tried to access a page without having ROLE_PRODUCTEUR');

        return $this->render('default/prod.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
