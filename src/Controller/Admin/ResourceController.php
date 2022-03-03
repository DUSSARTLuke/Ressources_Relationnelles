<?php

namespace App\Controller\Admin;

use App\Entity\Resource;
use App\Form\admin\ResourceAdminType;
use App\Form\CreationRessourceType;
use App\Form\ResourceAdminType;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourceController extends AbstractController
{
    /**
     * @Route(path="/admin/ressources", name="resources_admin")
     */
    public function adminResourceList(ResourceRepository $resourceRepository): Response
    {
        $resources = $resourceRepository->findAll();
        return $this->render('/pages/admin/resource/resourceListAdmin.html.twig', [
            'resources' => $resources
        ]);
//        return $this->render('/pages/ressources/list.html.twig', [
//            'ressources' => $resources
//        ]);
    }

    /**
     * @Route("/admin/consult/{id}", name="resource_consult_moderator")
     */
    public function ConsultRessources(Resource $resource): Response
    {
        return $this->render('pages/ressources/consultation.html.twig', [
            'ressource' => $resource
        ]);
    }

    /**
     * @Route(path="/admin/ressources/valider", name="resources_validation_admin")
     */
    public function adminResourceValidationList(ResourceRepository $resourceRepository): Response
    {

        $resources = $resourceRepository
            ->findAll();

        return $this->render('resources_admin', [
            'resources' => $resources
        ]);
    }

    /**
     * @Route(path="/admin/modifier-une-ressource/{id}", name="resource_admin_update")
     */
    public function updateResourceAdmin(Resource $resource, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ResourceAdminType::class, $resource);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resource = $form->getData();

            $em->persist($resource);
            $em->flush();

            $this->addFlash('success', 'La ressource a bien été modifiée');

            return $this->redirectToRoute('resources_admin');
        }

        return $this->renderForm('/includes/admin/resource/updateResourceFormAdmin.html.twig', [
            'form' => $form,
            'id' => $resource->getId()
        ]);
    }

    /**
     * @Route(path="/admin/delete/{id}", name="resource_admin_delete")
     */
    public function deleteRessource(EntityManagerInterface $manager, Resource $resource): Response
    {
        $resource->setStatus('DE');
        $manager->flush();

        $this->addFlash('success', 'La ressource a bien été supprimée');

        return $this->redirectToRoute('resources_admin');
    }

    /**
     * @Route(path="/admin/resource/valid/{id}", name="resource_moderator_valid")
     */
    public function validRessource(EntityManagerInterface $manager, Resource $resource): Response
    {
        $resource->setStatus('PU');
        $manager->flush();

        $this->addFlash('success', 'La ressource a bien été validée');

        return $this->redirectToRoute('resources_admin');
    }

    /**
     * @Route("/crer-une-ressource", name="resource_create_admin")
     */
    public function AddResource(Request $request, EntityManagerInterface $manager): Response
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

}
