<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
//    /**
//     * @Route("/categorie", name="categorie")
//     */
//    public function index()
//    {
//        return $this->render('categorie/index.html.twig', [
//            'controller_name' => 'CategorieController',
//        ]);
//    }

    /**
     * @Route("/categorie", name="categorie", requirements={"home"="^(?!register).+"})
     */

    public function ListeCategorie()
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categories=$repository->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/categorie-ajout", name="categorie-ajout", requirements={"categorie-ajout"="^(?!register).+"})
     * @Route("detail/{categorie}/modifier", name="categorie-modifier", requirements={"categorie-modifier"="^(?!register).+"})
     */

    public function formCategorie(Request $request, Categorie $categorie = null )
    {

        if(!$categorie){
            $categorie = new Categorie();
        }

        $form = $this->createForm(CategorieFormType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $this->addFlash('success', "Edition du categorie avec succès !");
            return $this->redirectToRoute('categorie');
        } else {
            return $this->render('categorie/edit-categorie.html.twig', [
                'formCategorie' => $form->createView(),
                'errors' => $form->getErrors()
            ]);

        }
    }

    /**
     * @Route("/delete-categorie/{categorie}", name="delete-categorie", requirements={"delete-categorie"="^(?!register).+"})
     */
    public function deleteCategorie(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        $this->addFlash('success', 'Ce categorie vient d\'être supprimé avec succès !');
        return $this->redirectToRoute('categorie');
    }
}
