<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index()
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

        /**
     * @Route("/compte-ajout", name="compte-ajout", requirements={"compte-ajout"="^(?!register).+"})
     * @Route("detail-compte/{compte}/modifier", name="compte-modifier", requirements={"compte-modifier"="^(?!register).+"})
     */
    public function form(Request $request, Compte $compte = null)
    {
        if(!$compte){
            $compte = new Compte();
        }

        $form = $this->createForm(CompteFormType::class, $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $compte = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($compte);
            $em->flush();
            $this->addFlash('success', "Edition du compte avec succès !");
            return $this->redirectToRoute('home');
        } else {
            return $this->render('compte/edit-compte.html.twig', [
                'formCompte' => $form->createView(),
                'errors' => $form->getErrors()
            ]);

        }
    }
}
