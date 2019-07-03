<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
//    /**
//     * @Route("/home", name="home")
//     */
//    public function index()
//    {
//        return $this->render('home/index.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
//    }

    /**
     * @Route("/", name="home", requirements={"home"="^(?!register).+"})
     */

    public function ListeComptes()
    {
        $repository = $this->getDoctrine()->getRepository(Compte::class);
        $comptes=$repository->findAll();
//        $comptes=$repository->findBy(array(), array('category' => 'asc'));

        return $this->render('home/index.html.twig', [
            'comptes' => $comptes
        ]);
    }

//    public function listeCompteBy()
//    {
//        // Recuperer l'id de l'utilisateur connecté
//        $userConnected = $this->get('security.token_storage')
//            ->getToken()
//            ->getUser();
//
//        //Recuperer les comptes de l'utilisateur connecté
//        $comptes = $this
//            ->getDoctrine()
//            ->getManager()
//            ->getRepository(Compte::class)
//            ->findBy(
//                ['gestionnaire' => $userConnected->getId()]
//            );
//        return $this->render('home/index.html.twig', [
//            'comptes' => $comptes
//        ]);
//    }
}
