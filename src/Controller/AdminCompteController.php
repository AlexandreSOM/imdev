<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCompteController extends AbstractController
{
//    /**
//     * @Route("/admin/compte", name="admin_compte")
//     */
//    public function index()
//    {
//        return $this->render('admin_compte/index.html.twig', [
//            'controller_name' => 'AdminCompteController',
//        ]);
//    }


//      //Fonction qui ajoute/edit un compte selon l'utilisateur connecté
//    /**
//     * @Route("/compte-ajout", name="compte-ajout", requirements={"compte-ajout"="^(?!register).+"})
//     * @Route("detail/{compte}/modifier", name="compte-modifier", requirements={"compte-modifier"="^(?!register).+"})
//     */
//    public function form(Request $request, Compte $compte = null)
//    {
//        if(!$compte){
//            $compte = new Compte();
//        }
//
//        $form = $this->createForm(CompteFormType::class, $compte);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $compte = $form->getData();
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($compte);
//            $em->flush();
//            $this->addFlash('success', "Edition du compte avec succès !");
//            return $this->redirectToRoute('home');
//        } else {
//            return $this->render('compte/edit-compte.html.twig', [
//                'formCompte' => $form->createView(),
//                'errors' => $form->getErrors()
//            ]);
//
//        }
//    }


    /**
     * @Route("/delete-compte/{compte}", name="delete-compte", requirements={"delete-compte"="^(?!regi ster).+"})
     */
    //   //Fonction supprime un COMPTE selon son ID

    public function deleteCompte(Compte $compte)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($compte);
        $em->flush();
        $this->addFlash('success', 'Ce compte vient d\'être supprimé avec succès !');
        return $this->redirectToRoute('home');
    }
}
