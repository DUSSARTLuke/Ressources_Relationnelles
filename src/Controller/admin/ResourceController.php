<?php

namespace App\Controller\admin;

use App\Entity\Resource;
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

        $resources = $resourceRepository
            ->findAll();

        return $this->render('/pages/resource/resourceList.admin.html.twig', [
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

        return $this->renderForm('/includes/resource/updateResourceForm.admin.html.twig', [
            'form' => $form,
            'id' => $resource->getId()
        ]);
    }

}
