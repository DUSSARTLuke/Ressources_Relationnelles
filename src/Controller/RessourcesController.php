<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Form\CreationRessourceType;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/ressources", name="ressources_")
 */
class RessourcesController extends AbstractController
{
    /**
     * @Route (path="/list_ressources", name="list")
     */
    public function voirMesRessources(ResourceRepository $repo)
    {
        $ressources = $repo->findBy(['createdBy' => $this->getUser()->getId()]);

        return $this->render('pages/ressources/list.html.twig', ['ressources' => $ressources]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function AddRessources(Request $request, EntityManagerInterface $manager): Response
    {
        $resource = new Resource();
        $form = $this->createForm(CreationRessourceType::class, $resource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource->setCreatedAt(new \DateTime());
            $resource->setCreatedBy($this->getUser());

            $manager->persist($resource);
            $manager->flush();

            $this->addFlash('success', " La demande de création de ressource a bien été prise en compte ! Un modérateur va vérifier les informations 
                pour valider sa création ! ");

            return $this->redirectToRoute('ressources_list');
        }

        return $this->render('pages/ressources/form.html.twig', ['form' => $form->createView(), 'from' => 'create']);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function EditRessources(Request $request, EntityManagerInterface $manager, Resource $resource): Response
    {
        $form = $this->createForm(CreationRessourceType::class, $resource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource->setUpdatedAt(new \DateTime());
            $manager->persist($resource);
            $manager->flush();

            $this->addFlash('success', " Votre ressource a bien été modifiée !");

            return $this->redirectToRoute('ressources_consult', ['id' => $resource->getId()]);
        }

        return $this->render('pages/ressources/form.html.twig', ['form' => $form->createView(), 'from' => 'edit']);
    }

    /**
     * @Route("/consult/{id}", name="consult")
     */
    public function ConsultRessources(Resource $resource): Response
    {
        return $this->render('pages/ressources/consultation.html.twig', [
            'ressource' => $resource
        ]);
    }

    /**
     * @Route(path="/delete/{id}", name="deleteRes")
     */
    public function deleteRessource(EntityManagerInterface $manager, Resource $resource): Response
    {
        $resource->setStatus('DE');
        $manager->flush();

        return $this->redirectToRoute('ressources_list');
    }
}
