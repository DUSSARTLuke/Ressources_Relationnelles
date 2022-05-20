<?php

namespace App\Controller\Admin;

use App\Entity\Resource;
use App\Form\admin\ResourceAdminType;
use App\Form\CreationRessourceType;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin/ressources/", name="ressources_admin_")
 */
class ResourceController extends AbstractController
{
    /**
     * @Route(path="list", name="list")
     */
    public function adminResourceList(ResourceRepository $resourceRepository): Response
    {
        $resources = $resourceRepository->findAll();
        return $this->render('/pages/admin/resource/resourceListAdmin.html.twig', [
            'resources' => $resources
        ]);
    }

    /**
     * @Route("consult/{id}", name="consult_moderator")
     */
    public function ConsultRessources(Resource $resource): Response
    {
        return $this->render('pages/ressources/consultation.html.twig', [
            'ressource' => $resource,
            'favRes' => []
        ]);
    }

    /**
     * @Route(path="valider", name="validation")
     */
    public function adminResourceValidationList(ResourceRepository $resourceRepository): Response
    {
        $resources = $resourceRepository->findAll();

        return $this->render('/pages/admin/resource/resourceListAdmin.html.twig', [
            'resources' => $resources
        ]);
    }

    /**
     * @Route(path="modifier/{id}", name="update")
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

            return $this->redirectToRoute('ressources_admin_list');
        }

        return $this->renderForm('/includes/admin/resource/updateResourceFormAdmin.html.twig', [
            'form' => $form,
            'id' => $resource->getId()
        ]);
    }

    /**
     * @Route(path="delete/{id}", name="delete")
     */
    public function deleteRessource(EntityManagerInterface $manager, Resource $resource): Response
    {
        $resource->setStatus('DE');
        $manager->flush();

        $this->addFlash('success', 'La ressource a bien été supprimée');

        return $this->redirectToRoute('ressources_admin_list');
    }

    /**
     * @Route(path="valid/{id}", name="moderator_valid")
     */
    public function validRessource(EntityManagerInterface $manager, Resource $resource): Response
    {
        $resource->setStatus('PU');
        $manager->flush();

        $this->addFlash('success', 'La ressource a bien été validée');

        return $this->redirectToRoute('ressources_admin_list');
    }

    /**
     * @Route("creer", name="create")
     */
    public function AddResource(Request $request, EntityManagerInterface $manager): Response
    {
        $resource = new Resource();
        $form = $this->createForm(CreationRessourceType::class, $resource, ['csrf_protection' => false]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource->setCreatedAt(new \DateTime());
            $resource->setCreatedBy($this->getUser());

            $manager->persist($resource);
            $manager->flush();

            $this->addFlash('success', " La demande de création de ressource a bien été prise en compte ! Un modérateur va vérifier les informations 
                pour valider sa création ! ");

            return $this->redirectToRoute('ressources_admin_list');
        }

        return $this->render('pages/ressources/form.html.twig', ['form' => $form->createView(), 'from' => 'create']);
    }

}
