<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Form\CreationRessourceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/ressources/", name="creation_")
 */
class RessourcesAddController extends AbstractController
{
    /**
     * @Route("ressource", name="ressource")
     */
    public function AddRessources(Request $request, EntityManagerInterface $manager): Response
    {
        $resource = new Resource();
        $form = $this->createForm(CreationRessourceType::class, $resource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->get('name')->getData();
            if ($name = '' or $name = null) {
                $this->addFlash('warning', 'Veuillez renseigner un nom pour votre ressource');
            }
            $name = $form->get('name')->getData();
            if ($name = '' or $name = null) {
                $this->addFlash('warning', 'Veuillez renseigner un nom pour votre ressource');
            }
            $manager->persist($resource);
            $manager->flush();

            $this->addFlash('success', " La demande de création de ressource a bien été prise en compte ! Un modérateur va vérifier les informations 
                pour valider sa création ! ");

            return $this->redirectToRoute('home');
        }

        return $this->render('ressources/ressourcesAdd.html.twig', ['form' => $form->createView()]);
    }
}



