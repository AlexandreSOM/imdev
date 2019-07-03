<?php

namespace App\Controller;

use App\Entity\Gestionnaire;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
//    /**
//     * @Route("/edit-admin", name="edit-admin")
//     */
//    public function index()
//    {
//        return $this->render('admin/index.html.twig', [
//            'controller_name' => 'AdminController',
//        ]);
//    }

    //Fonction qui recupère les gestionnaires et les tri par ordre croissant
    /**
     * @Route("/edit-admin", name="edit-admin", requirements={"edit-admin"="^(?!register).+"})
     */
    public function listeGestionnaire()
    {
        $repository = $this->getDoctrine()->getRepository(Gestionnaire::class);
        $gestionnaires=$repository->findAll();
        //        $comptes=$repository->findBy(array(), array('category' => 'asc'));
        return $this->render('admin/index.html.twig', [
            'gestionnaires' => $gestionnaires
        ]);
    }

    //Fonction ajout/edit des GESTIONNAIRE qui recupère les données du formulaire, les enregistres et les renvoie a la vue
    /**
     * @Route("/gestion/admin/{gestionnaire}/modifier", name="gestionnaire-modifier", requirements={"gestionnaire-ajout"="^(?!register).+"})
     */
    public function form(Request $request,  Gestionnaire $gestionnaire = null)
    {
        if(!$gestionnaire){
            $gestionnaire = new Gestionnaire();
        }
        $form = $this->createForm(RegistrationFormType::class, $gestionnaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $gestionnaire = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestionnaire);
            $em->flush();
            $this->addFlash('success', "Edition du gestionnaire avec succès !");
            return $this->redirectToRoute('admin/index.html.twig');
        } else {
            return $this->render('admin/edit-admin.html.twig', [
                'registrationForm' => $form->createView(), 'errors' => $form->getErrors()
            ]);

        }
    }

    //Fonction supprime un GESTIONNAIRE selon son ID

    /**
     * @Route("/delete-gestionnaire/{gestionnaire}", name="delete-gestionnaire", requirements={"delete-gestionnaire"="^(?!register).+"})
     */
    public function removeAdmin(Gestionnaire $gestionnaire)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gestionnaire);
        $em->flush();
        $this->addFlash('success', 'Ce gestionnaire vient d\'être supprimé avec succès !');
        return $this->redirectToRoute('admin');
    }
}
